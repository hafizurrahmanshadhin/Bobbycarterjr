<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    /**
     * Get the owning notifiable model.
     *
     * @return MorphTo
     */
    public function notifiable(): MorphTo {
        return $this->morphTo();
    }
}
