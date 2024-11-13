<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
    /**
     * Get all notifications for the authenticated user.
     *
     * @return JsonResponse
     */
    public function GetNotifications(): JsonResponse {
        try {
            $user          = Auth::user();
            $notifications = Notification::where('notifiable_id', $user->id)
                ->where('notifiable_type', get_class($user))
                ->with('notifiable')
                ->get();

            return Helper::jsonResponse(true, 'Notifications retrieved successfully.', 200, NotificationResource::collection($notifications));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while retrieving notifications.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Mark a notification as read.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function MarkAsRead(Request $request): JsonResponse {
        try {
            $request->validate([
                'notification_id' => 'required|uuid',
            ]);

            //* Get the authenticated user
            $user = Auth::user();

            //! Find the notification based on ID and user
            $notification = $user->notifications()
                ->where('id', $request->notification_id)
                ->first();

            //? If the notification doesn't exist, return a 404 error
            if (!$notification) {
                return Helper::jsonResponse(false, 'Notification not found', 404);
            }

            //* Mark the notification as read
            $notification->markAsRead();

            //! Return success response
            return Helper::jsonResponse(true, 'Notification marked as read', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to mark notification as read', 500, ['error' => $e->getMessage()]);
        }
    }
}
