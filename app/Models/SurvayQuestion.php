<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Option;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurvayQuestion extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'questions',
        'marks',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'course_id' => 'integer',
            'questions' => 'string',
            'marks'     => 'integer',
            'status'    => 'string',
        ];
    }

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }

    public function userResponses(): HasMany {
        return $this->hasMany(UserResponse::class);
    }
}
