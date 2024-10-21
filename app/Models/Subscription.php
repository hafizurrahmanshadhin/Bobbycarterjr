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
