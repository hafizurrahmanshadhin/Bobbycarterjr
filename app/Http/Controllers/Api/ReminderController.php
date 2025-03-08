<?php
namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReminderResource;
use App\Models\FirebaseToken;
use App\Models\Reminder;
use App\Notifications\ReminderNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Log;

class ReminderController extends Controller {
    public function reminderStore(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'headline'      => 'required|string|max:255',
            'description'   => 'required|string',
            'reminder_date' => 'required|date',
            'reminder_time' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {
            $reminder = Reminder::create([
                'user_id'       => Auth::user()->id,
                'headline'      => $request->headline,
                'description'   => $request->description,
                'reminder_date' => $request->reminder_date,
                'reminder_time' => $request->reminder_time,
            ]);

            //! Schedule the notification
            $reminderDateTime = Carbon::parse($request->reminder_date . ' ' . $request->reminder_time);
            $delay            = $reminderDateTime->diffInSeconds(Carbon::now());

            Notification::send(Auth::user(), (new ReminderNotification($request->headline, $request->description))->delay($delay));

            //* Send push notification
            $this->sendPushNotification(Auth::user()->id, $request->headline, $request->description);

            $formattedTime = Carbon::parse($reminder->reminder_time)->format('h:i A');

            $reminderData = [
                'id'            => $reminder->id,
                'user_id'       => $reminder->user_id,
                'headline'      => $reminder->headline,
                'description'   => $reminder->description,
                'reminder_date' => $reminder->reminder_date,
                'reminder_time' => $formattedTime,
            ];

            return Helper::jsonResponse(true, 'Reminder Created Successfully.', 200, $reminderData);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while creating the reminder.', 500, $e->getMessage());
        }
    }

    private function sendPushNotification($userId, $headline, $description) {
        try {
            $factory   = (new Factory)->withServiceAccount(storage_path('app/firebase_push_Nofifications.json'));
            $messaging = $factory->createMessaging();

            $tokens = FirebaseToken::where('user_id', $userId)->pluck('token')->toArray();

            if (empty($tokens)) {
                return;
            }

            $notification = FirebaseNotification::create($headline, $description);
            $message      = CloudMessage::new ()->withNotification($notification);

            $messaging->sendMulticast($message, $tokens);
        } catch (Exception $e) {
            Log::error("Failed to send push notification to user ID: $userId. Error: {$e->getMessage()}");
        }
    }

    public function SingleReminder(int $id) {
        $data = Reminder::findOrFail($id);

        if ($data === null) {
            return Helper::jsonResponse(false, 'Course Reminder not found', 404, []);
        }

        return Helper::jsonResponse(true, 'Course Reminder retrieved successfully', 200, $data);
    }

    public function getAllReminders() {
        $reminder = Reminder::where('user_id', auth()->id())->get();

        if ($reminder->isEmpty()) {
            return Helper::jsonResponse(true, 'Reminder not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Reminder retrieved successfully', 200, ReminderResource::collection($reminder));
    }

    public function reminderDelete(int $id) {
        $data = Reminder::findOrFail($id);
        $data->delete();

        return Helper::jsonResponse(true, 'Reminder Deleted', 200, []);
    }

    public function reminderUpdate(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'headline'      => 'required|string|max:255',
            'description'   => 'required|string',
            'reminder_date' => 'required|date',
            'reminder_time' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {
            $reminder = Reminder::findOrFail($id);

            $data = $reminder->update([
                'headline'      => $request->headline,
                'description'   => $request->description,
                'reminder_date' => $request->reminder_date,
                'reminder_time' => $request->reminder_time,
            ]);

            return Helper::jsonResponse(true, 'Reminder Updated', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while updating the reminder.', 500, $e->getMessage());
        }
    }
}
