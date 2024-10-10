<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'id' => 'integer',
            'subscription_id' => 'integer',
        ];
    }
}
