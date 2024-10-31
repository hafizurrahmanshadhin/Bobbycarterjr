<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        DB::table('users')->insert([
            [
                'id'                => 1,
                'is_subscribed'     => 0,
                'firstName'         => 'admin',
                'lastName'          => 'admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'address'           => null,
                'google_id'         => null,
                'facebook_id'       => null,
                'otp_verified_at'   => null,
                'role'              => 'admin',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2024-09-05 04:06:22',
                'updated_at'        => '2024-09-05 10:07:59',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'is_subscribed'     => 0,
                'firstName'         => 'user',
                'lastName'          => 'user',
                'email'             => 'user@user.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'address'           => null,
                'google_id'         => null,
                'facebook_id'       => null,
                'otp_verified_at'   => null,
                'role'              => 'user',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2024-09-05 04:07:08',
                'updated_at'        => '2024-09-05 10:07:37',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'is_subscribed'     => 1,
                'firstName'         => 'Hafizur',
                'lastName'          => 'Rahman',
                'email'             => 'shadhin666@gmail.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'address'           => null,
                'google_id'         => null,
                'facebook_id'       => null,
                'otp_verified_at'   => null,
                'role'              => 'user',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2024-10-21 05:15:44',
                'updated_at'        => '2024-10-21 05:15:44',
                'deleted_at'        => null,
            ],
            [
                'id'                => 4,
                'is_subscribed'     => 1,
                'firstName'         => 'Premium',
                'lastName'          => 'Premium',
                'email'             => 'premium@premium.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'address'           => null,
                'google_id'         => null,
                'facebook_id'       => null,
                'otp_verified_at'   => null,
                'role'              => 'user',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2024-10-21 05:15:44',
                'updated_at'        => '2024-10-21 05:15:44',
                'deleted_at'        => null,
            ],
        ]);
    }
}
