<?php

namespace App\Console\Commands;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Console\Command;

class CheckExpiredSubscriptions extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired subscriptions and update user subscription status';

    /**
     * Execute the console command.
     */
    public function handle() {
        $expiredMemberships = Membership::where('end_date', '<=', now())->get();

        foreach ($expiredMemberships as $membership) {
            $user = $membership->user;

            //* Set the user's subscription status to inactive
            $user->is_subscribed = 0;
            $user->save();
        }

        $this->info('Expired subscriptions have been updated.');
    }
}
