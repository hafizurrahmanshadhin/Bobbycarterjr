<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'otp_verified_at',
        'google_id',
        'facebook_id',
        'role',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'password'          => 'hashed',
            'firstName'         => 'string',
            'lastName'          => 'string',
            'email'             => 'string',
            'email_verified_at' => 'datetime',
            'avatar'            => 'string',
            'address'           => 'string',
            'google_id'         => 'string',
            'facebook_id'       => 'string',
            'role'              => 'string',
            'status'            => 'string',
        ];
    }

    public function userResponses(): HasMany
    {
        return $this->hasMany(UserResponse::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_users')
            ->withPivot('is_read')
            ->withTimestamps();
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    // Define the relationship with the Bookmark model
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    // Optional: Relationship to get bookmarked articles directly
    public function bookmarkedArticles()
    {
        return $this->belongsToMany(Article::class, 'bookmarks')->withTimestamps();
    }
}
