<?php

namespace App\Models;

use App\Models\Task;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'module_id',
        'url',
        'answer',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
    ];

    protected function casts(): array {
        return [
            'module_id' => 'integer',
            'url'     => 'string',
            'answer'  => 'string',
            'status'  => 'string',
        ];
    }

    public function task(): BelongsTo {
        return $this->belongsTo(Task::class);
    }

    public function userResponses(): HasMany {
        return $this->hasMany(UserResponse::class);
    }
}
