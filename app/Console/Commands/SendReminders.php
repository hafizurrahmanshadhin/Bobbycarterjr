<?php

namespace App\Console\Commands;

use App\Models\FirebaseToken;
use App\Models\Reminder;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class SendReminders extends Command {
    protected $signature   = 'send:reminders';
    protected $description = 'Send reminders to users based on their set reminder date and time';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $now       = Carbon::now();
        $reminders = Reminder::where('reminder_date', $now->toDateString())
            ->where('reminder_time', $now->format('H:i:s'))
            ->get();

        foreach ($reminders as $reminder) {
            $user = $reminder->user;
            if ($user) {
                $notification = new ReminderNotification($reminder->headline, $reminder->description);
                $user->notify($notification);

                $this->sendPushNotification($user->id, $notification->toPushNotification($user));
            }
        }

        $this->info('Reminders sent successfully.');
    }

    protected function sendPushNotification($userId, $notificationData) {
        try {
            Log::info("Attempting to send push notification to user ID: $userId");

            $factory   = (new Factory)->withServiceAccount(storage_path('app/firebase_push_Nofifications.json'));
            $messaging = $factory->createMessaging();

            $tokens = FirebaseToken::where('user_id', $userId)->pluck('token')->toArray();

            if (empty($tokens)) {
                Log::info("No active Firebase tokens found for user ID: $userId");
                return;
            }

            Log::info("Firebase tokens for user ID: $userId", ['tokens' => $tokens]);

            $notification = FirebaseNotification::create($notificationData['title'], $notificationData['body']);
            $message      = CloudMessage::new ()->withNotification($notification);

            Log::info("Notification payload for user ID: $userId", [
                'title' => $notificationData['title'],
                'body'  => $notificationData['body'],
            ]);

            $messaging->sendMulticast($message, $tokens);

            Log::info("Push notification sent successfully to user ID: $userId");
        } catch (Exception $e) {
            Log::error("Failed to send push notification to user ID: $userId. Error: {$e->getMessage()}");
        }
    }
}
