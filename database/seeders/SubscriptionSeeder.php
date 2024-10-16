<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\SubscriptionDetail;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now(); // Store the current timestamp

        // Seed subscriptions with timestamps
        $subscriptions = [
            [
                'type' => 'free',
                'price' => null,
                'expire_at' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type' => 'premium',
                'price' => 9.99,
                'expire_at' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Subscription::insert($subscriptions);

        // Seed subscription details with timestamps
        $subscriptionDetails = [
            [
                'subscription_id' => 1,
                'title' => 'Free Plan',
                'description' => 'Access to basic features.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'subscription_id' => 2,
                'title' => 'Premium Plan',
                'description' => 'Access to all features and priority support.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        SubscriptionDetail::insert($subscriptionDetails);
    }

}
