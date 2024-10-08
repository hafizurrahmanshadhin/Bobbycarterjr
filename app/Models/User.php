<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
}
