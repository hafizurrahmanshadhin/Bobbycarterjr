<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\SocialLoginController;
use App\Http\Controllers\Api\ReminderController;
use Illuminate\Support\Facades\Route;

//! Auth Routes
Route::post('/register', [RegisterController::class, 'Register']);
Route::post('/login', [LoginController::class, 'Login']);
Route::post('/logout', [LogoutController::class, 'Logout'])->middleware('auth:sanctum');
Route::post('/send-otp', [PasswordResetController::class, 'SendOtpToEmail']);
Route::post('/verify-otp', [PasswordResetController::class, 'VerifyOTP']);
Route::post('/reset-password', [PasswordResetController::class, 'ResetPassword']);

//! Route For Socialite Login.
Route::post('/social-login', [SocialLoginController::class, 'SocialLogin']);
