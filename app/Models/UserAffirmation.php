<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAffirmation extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'notifications_count',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'user_id'             => 'integer',
            'notifications_count' => 'integer',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
