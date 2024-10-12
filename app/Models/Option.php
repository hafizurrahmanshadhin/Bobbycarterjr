<?php

namespace App\Models;

use App\Models\SurvayQuestion;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'survay_question_id',
        'options',
        'is_correct',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected function casts(): array {
        return [
            'survay_question_id' => 'integer',
            'options'            => 'string',
            'is_correct'         => 'boolean',
            'status'             => 'string',
        ];
    }

    public function survayQuestion(): BelongsTo {
        return $this->belongsTo(SurvayQuestion::class);
    }

    public function userResponses(): HasMany {
        return $this->hasMany(UserResponse::class);
    }
}
