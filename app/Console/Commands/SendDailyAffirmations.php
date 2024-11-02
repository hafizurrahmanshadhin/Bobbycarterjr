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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-affirmations {time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily affirmations to users based on their preferences';

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     ** Execute the console command.
     *
     * Retrieves the latest daily affirmation and sends notifications to users
     * who have set the specified notification time. Notifications are sent as
     * both in-app and push notifications.
     *
     * @return void
     */
    public function handle(): void {
        $time = $this->argument('time');

        //! Retrieve the latest daily affirmation message
        $affirmation = DailyAffirmation::latest()->first();
        if (!$affirmation) {
            Log::warning('No daily affirmation found.');
            return;
        }

        //* Fetch users who have set their notification time to the specified time
        $users = UserAffirmation::with('user')
            ->where('notification_time', $time)
            ->get();

        foreach ($users as $userAffirmation) {
            $user = $userAffirmation->user;
            if ($user) {
                //! Send in-app notification
                $notification = new DailyAffirmationNotification($affirmation->notification);
                $user->notify($notification);

                Log::info("Daily affirmation sent to user ID: {$user->id}");

                //! Send push notification
                $this->sendPushNotification($user->id, $notification->toPushNotification($user));
            }
        }

        $this->info('Daily affirmations sent successfully.');
    }

    /**
     ** Send a push notification to the user using Firebase.
     *
     * This method retrieves the user's Firebase tokens and sends a push
     * notification using the provided notification data. Logs are added
     * for each step to track the process and handle any errors.
     *
     * @param int   $userId           The ID of the user to notify
     * @param array $notificationData  The notification data (title and body)
     * @return void
     */
    protected function sendPushNotification($userId, $notificationData): void {
        try {
            Log::info("Attempting to send push notification to user ID: $userId");

            //! Initialize Firebase factory and messaging service
            $factory   = (new Factory)->withServiceAccount(storage_path('app/firebase-auth.json'));
            $messaging = $factory->createMessaging();

            //* Retrieve user's Firebase tokens
            $tokens = FirebaseToken::where('user_id', $userId)->pluck('token')->toArray();

            //? Check if tokens exist; log and return if not
            if (empty($tokens)) {
                Log::info("No active Firebase tokens found for user ID: $userId");
                return;
            }

            //! Log the tokens for debugging
            Log::info("Firebase tokens for user ID: $userId", ['tokens' => $tokens]);

            //* Create the Firebase notification with title and body
            $notification = FirebaseNotification::create($notificationData['title'], $notificationData['body']);
            $message      = CloudMessage::new ()->withNotification($notification);

            //! Log the notification payload details
            Log::info("Notification payload for user ID: $userId", [
                'title' => $notificationData['title'],
                'body'  => $notificationData['body'],
            ]);

            //* Send the push notification to all valid tokens
            $messaging->sendMulticast($message, $tokens);

            Log::info("Push notification sent successfully to user ID: $userId");
        } catch (Exception $e) {
            Log::error("Failed to send push notification to user ID: $userId. Error: {$e->getMessage()}");
        }
    }
}
