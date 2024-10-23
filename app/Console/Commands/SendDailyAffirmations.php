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
    protected $description = 'Send daily affirmations to users';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $affirmation = DailyAffirmation::latest()->first();
        if (!$affirmation) {
            Log::warning('No daily affirmation found.');
            return;
        }

        $users = UserAffirmation::with('user')->get();
        foreach ($users as $userAffirmation) {
            $user = $userAffirmation->user;
            if ($user) {
                $notification = new DailyAffirmationNotification($affirmation->notification);
                $user->notify($notification);
                $this->sendPushNotification($user->id, $notification->toPushNotification($user));
            }
        }

        $this->info('Daily affirmations sent successfully.');
    }

    protected function sendPushNotification($userId, $notificationData) {
        try {
            $factory   = (new Factory)->withServiceAccount(storage_path('app/firebase-auth.json'));
            $messaging = $factory->createMessaging();

            $tokens = FirebaseToken::where('user_id', $userId)
                ->pluck('token')
                ->toArray();

            if (empty($tokens)) {
                Log::info("No active Firebase tokens found for user ID: $userId");
                return;
            }

            $notification = FirebaseNotification::create($notificationData['title'], $notificationData['body']);
            $message      = CloudMessage::new ()
                ->withNotification($notification);

            $messaging->sendMulticast($message, $tokens);

            Log::info("Push notification sent successfully to user ID: $userId");
        } catch (Exception $e) {
            Log::error("Failed to send push notification: {$e->getMessage()}");
        }
    }
}
