<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'image_url',
        'description',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'status',
    ];

    protected function casts(): array {
        return [
            'user_id' => 'integer',
            'title'     => 'string',
            'description'  => 'string',
            'image_url'  => 'string',
            'status'  => 'string',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
