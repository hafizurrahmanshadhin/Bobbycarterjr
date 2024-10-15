<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array {
        return [
            'user_id' => 'integer',
            'article_id' => 'integer'
        ];
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Article model
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
