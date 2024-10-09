<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(SubscriptionDetail::class);
    }

    protected $casts = [
        'expire_at' => 'datetime',
    ];
}
