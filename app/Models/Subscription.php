<?php

namespace App\Models;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model {
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'id'        => 'integer',
            'expire_at' => 'integer',
        ];
    }

    public function details() {
        return $this->hasMany(SubscriptionDetail::class);
    }

    public function membership(): HasOne {
        return $this->hasOne(Membership::class);
    }
}





//! This methid will work when working on payment gateway
// public function activateSubscription($userId, $subscriptionId) {
//     $user = User::findOrFail($userId);
//     $subscription = Subscription::findOrFail($subscriptionId);

//     // Calculate the start and end dates based on the subscription period
//     $startDate = now();
//     $endDate = now()->addMonths($subscription->expire_at);

//     // Create the membership record
//     Membership::create([
//         'user_id' => $user->id,
//         'subscription_id' => $subscription->id,
//         'start_date' => $startDate,
//         'end_date' => $endDate,
//     ]);

//     // Set the user's subscription status to active
//     $user->is_subscribed = 1;
//     $user->save();

//     return response()->json(['message' => 'Subscription activated successfully']);
// }

