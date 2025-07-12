<?php

namespace App\Models;

use App\Models\FirebaseToken;
use App\Models\Membership;
use App\Models\UserAffirmation;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
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

    protected function casts(): array {
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

    public function userResponses(): HasMany {
        return $this->hasMany(UserResponse::class);
    }

    public function articles() {
        return $this->belongsToMany(Article::class, 'article_users')
            ->withPivot('is_read')
            ->withTimestamps();
    }

    public function journals() {
        return $this->hasMany(Journal::class);
    }

    public function reminders() {
        return $this->hasMany(Reminder::class);
    }

    // Optional: Relationship to get bookmarked articles directly
    public function bookmarkedArticles() {
        return $this->belongsToMany(Article::class, 'bookmarks')->withTimestamps();
    }

    // Define the relationship with the Bookmark model
    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }

    // Relationship with UserRecommended
    public function recommendations() {
        return $this->hasMany(UserRecommended::class);
    }

    public function completedModules() {
        return $this->belongsToMany(Module::class, 'user_modules_completes');
    }

    public function articleCompletes() {
        return $this->hasMany(UserArticleComplete::class);
    }

    public function membership(): HasOne {
        return $this->hasOne(Membership::class);
    }

    public function firebaseTokens(): HasMany {
        return $this->hasMany(FirebaseToken::class);
    }

    public function userAffirmation(): HasOne {
        return $this->hasOne(UserAffirmation::class);
    }

    public function getFullNameAttribute() {
        return trim($this->firstName . ' ' . $this->lastName);
    }

    /**
     * Check if user is a guest
     *
     * @return bool
     */
    public function isGuest(): bool {
        return $this->role === 'guest';
    }
}
