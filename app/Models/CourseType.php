<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseType extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'name'   => 'string',
            'status' => 'string',
        ];
    }
}
