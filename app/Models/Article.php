<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'image_url',
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
            'course_id' => 'integer',
            'title'     => 'string',
            'description'  => 'string',
            'image_url'  => 'string',
            'status'  => 'string',
        ];
    }

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'article_users')
                    ->withPivot('is_read')
                    ->withTimestamps();
    }
}
