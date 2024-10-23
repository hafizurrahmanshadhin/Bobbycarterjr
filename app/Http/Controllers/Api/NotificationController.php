<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\FirebaseToken;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class NotificationController extends Controller {
    /**
     * Get all notifications for the authenticated user.
     */
    public function GetNotifications(): JsonResponse {
        try {
            $user = Auth::user();

            if (!$user) {
                return Helper::jsonResponse(false, 'Unauthorized', 401);
            }

            $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
            return Helper::jsonResponse(true, 'Notifications Retrieved Successfully', 200, NotificationResource::collection($notifications));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve notifications', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Mark a notification as read.
     */
    public function MarkAsRead(Request $request): JsonResponse {
        try {
            $request->validate(['notification_id' => 'required|uuid']);
            $user         = Auth::user();
            $notification = $user->notifications()->where('id', $request->notification_id)->first();

            if (!$notification) {
                return Helper::jsonResponse(false, 'Notification not found', 404);
            }

            $notification->markAsRead();
            return Helper::jsonResponse(true, 'Notification marked as read', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to mark notification as read', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Send push notification to mobile devices.
     */
    public function sendNotifyMobile($user_id, $title, $body, $data = []): void {
        try {
            $factory   = (new Factory)->withServiceAccount(storage_path('app/firebase-auth.json'));
            $messaging = $factory->createMessaging();

            $tokens = FirebaseToken::where('user_id', $user_id)->pluck('token')->toArray();

            if (empty($tokens)) {
                Log::info("No active Firebase tokens found for user ID: $user_id");
                return;
            }

            $notification = Notification::create($title, $body);
            $message      = CloudMessage::new ()
                ->withNotification($notification)
                ->withData($data);

            foreach ($tokens as $token) {
                $messaging->send($message->withChangedTarget('token', $token));
            }

            Log::info("Push notification sent to user ID: $user_id");
        } catch (Exception $e) {
            Log::error("Failed to send push notification: " . $e->getMessage());
        }
    }
}
