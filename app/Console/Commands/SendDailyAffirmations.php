<?php

namespace App\Console\Commands;

use App\Models\DailyAffirmation;
use App\Models\FirebaseToken;
use App\Models\UserAffirmation;
use App\Notifications\DailyAffirmationNotification;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class SendDailyAffirmations extends Command {
    protected $signature   = 'send:daily-affirmations';
    protected $description = 'Send daily affirmations to users based on their preferences';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        //* Get the latest daily affirmation message
        $affirmation = DailyAffirmation::latest()->first();
        if (!$affirmation) {
            Log::warning('No daily affirmation found.');
            return;
        }

        //! Fetch all user affirmations with user data
        $users = UserAffirmation::with('user')->get();

        //* Loop through each user and send notifications based on user preferences
        foreach ($users as $userAffirmation) {
            $user = $userAffirmation->user;
            if ($user) {
                //! Send in-app notification
                $notification = new DailyAffirmationNotification($affirmation->notification);
                $user->notify($notification);

                //* Send push notification
                $this->sendPushNotification($user->id, $notification->toPushNotification($user));
            }
        }

        $this->info('Daily affirmations sent successfully.');
    }

    /**
     * Send push notification to the user using Firebase.
     *
     * @param int $userId
     * @param array $notificationData
     */
    protected function sendPushNotification($userId, $notificationData) {
        try {
            // Log the start of the push notification process
            Log::info("Attempting to send push notification to user ID: $userId");

            $factory   = (new Factory)->withServiceAccount(storage_path('app/firebase-auth.json'));
            $messaging = $factory->createMessaging();

            //! Fetch the user's Firebase tokens
            $tokens = FirebaseToken::where('user_id', $userId)->pluck('token')->toArray();

            if (empty($tokens)) {
                Log::info("No active Firebase tokens found for user ID: $userId");
                return;
            }

            // Log the Firebase tokens that will be used
            Log::info("Firebase tokens for user ID: $userId", ['tokens' => $tokens]);

            //* Create the notification payload for Firebase
            $notification = FirebaseNotification::create($notificationData['title'], $notificationData['body']);
            $message      = CloudMessage::new ()->withNotification($notification);

            //! Log the notification data before sending
            Log::info("Notification payload for user ID: $userId", [
                'title' => $notificationData['title'],
                'body'  => $notificationData['body'],
            ]);

            //! Send the push notification to all valid tokens
            $messaging->sendMulticast($message, $tokens);

            Log::info("Push notification sent successfully to user ID: $userId");
        } catch (Exception $e) {
            Log::error("Failed to send push notification to user ID: $userId. Error: {$e->getMessage()}");
        }
    }
}
