<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\SubscriptionDetail;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $now = Carbon::now();

        $subscriptions = [
            [
                'type'       => 'free',
                'price'      => null,
                'expire_at'  => 7, // 7 days
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type'       => 'premium',
                'price'      => 9.99,
                'expire_at'  => 6, // 6 months
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Subscription::insert($subscriptions);

        $subscriptionDetails = [
            [
                'subscription_id' => 1,
                'title'           => 'Free Plan',
                'description'     => 'Access to basic features.',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'subscription_id' => 2,
                'title'           => 'Premium Plan',
                'description'     => 'Access to all features and priority support.',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ];

        SubscriptionDetail::insert($subscriptionDetails);
    }
}
