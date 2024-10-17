<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArticleComplete extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'mark'
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected function casts(): array {
        return [
            'user_id' => 'integer',
            'article_id' => 'integer',
            'mark'    => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
