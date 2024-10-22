<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\SocialLoginController;
use App\Http\Controllers\Api\ReminderController;
use Illuminate\Support\Facades\Route;

//! Auth Routes
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
Route::post('/send-otp', [PasswordResetController::class, 'sendOtpToEmail'])->name('send.otp');
Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset.password');

//! Route For Socialite Login
Route::post('/social-login', [SocialLoginController::class, 'socialLogin'])->name('social.login');

// Protected Routes
Route::group(['middleware' => ['auth:sanctum', 'is_active']], function () {
    Route::controller(ReminderController::class)->group(function () {
        Route::get('/reminders', 'getAllReminders')->name('reminders.index');
        Route::get('/single-reminder/{id}', 'singleReminder')->name('reminders.show');
        Route::post('/reminder/store', 'reminderStore')->name('reminders.store');
        Route::delete('/reminder/delete/{id}', 'reminderDelete')->name('reminders.delete');
        Route::post('/reminder/update/{id}', 'reminderUpdate')->name('reminders.update');
    });
});
