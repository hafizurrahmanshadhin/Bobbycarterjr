<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseType extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
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
            'id'     => 'integer',
            'name'   => 'string',
            'image'  => 'string',
            'status' => 'string',
        ];
    }

    public function courses(): HasMany {
        return $this->hasMany(Course::class);
    }
}
