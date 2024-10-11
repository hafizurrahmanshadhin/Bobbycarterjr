<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'content',
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
            'content'   => 'string',
            'status'    => 'string',
        ];
    }

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function task(): HasOne {
        return $this->hasOne(Task::class);
    }
}
