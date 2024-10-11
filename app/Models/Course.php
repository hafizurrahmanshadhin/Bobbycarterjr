<?php

namespace App\Models;

use App\Models\CourseType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model {
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'course_type_id' => 'integer',
            'name'           => 'string',
            'status'         => 'string',
        ];
    }

    public function courseType(): BelongsTo {
        return $this->belongsTo(CourseType::class);
    }
}
