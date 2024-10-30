<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'headline',
        'description',
        'reminder_date',
        'reminder_time',
        'status',
    ];

    protected $hidden = [
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'user_id'       => 'integer',
        'reminder_date' => 'date',
        'reminder_time' => 'datetime:H:i',
        'status'        => 'string',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
