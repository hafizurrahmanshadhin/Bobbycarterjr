<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\SocialLoginController;
use App\Http\Controllers\Api\FirebaseTokenController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ReminderController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserAffirmationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoiceController;
use Illuminate\Support\Facades\Route;

//! Auth Routes
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
Route::post('/send-otp', [PasswordResetController::class, 'sendOtpToEmail'])->name('send.otp');
Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset.password');

Route::post('/user/free-status', [UserController::class, 'updateFreeStatus'])->middleware('auth:sanctum');

//! Route For Socialite Login
Route::post('/social-login', [SocialLoginController::class, 'socialLogin'])->name('social.login');

Route::controller(SubscriptionController::class)->group(function () {
    Route::get('/package/free', 'freePackage');
    Route::get('/package/premium', 'premiumPackage');
});

//! Reminder Routes
Route::group(['middleware' => ['auth:sanctum', 'is_active']], function () {
    Route::controller(ReminderController::class)->group(function () {
        Route::get('/reminders', 'getAllReminders')->name('reminders.index');
        Route::get('/single-reminder/{id}', 'singleReminder')->name('reminders.show');
        Route::post('/reminder/store', 'reminderStore')->name('reminders.store');
        Route::delete('/reminder/delete/{id}', 'reminderDelete')->name('reminders.delete');
        Route::post('/reminder/update/{id}', 'reminderUpdate')->name('reminders.update');
    });
});

//! Firebase Token Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/firebase/token/add', [FirebaseTokenController::class, 'StoreFirebaseToken']);
    Route::post('/firebase/token/get', [FirebaseTokenController::class, 'GetFirebaseToken']);
    Route::post('/firebase/token/delete', [FirebaseTokenController::class, 'DeleteFirebaseToken']);
});

//! User Affirmation Route
Route::post('/user/affirmation', [UserAffirmationController::class, 'storeOrUpdateAffirmation'])->middleware('auth:sanctum');

//! Notification Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'GetNotifications']);
    Route::post('/notifications/read', [NotificationController::class, 'MarkAsRead']);
});

//! Message Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/messages/{user}', [MessageController::class, 'GetMessages']);
    Route::post('/messages/{user}', [MessageController::class, 'SendMessage']);
    Route::get('/users-with-last-message', [MessageController::class, 'GetUsersWithLastMessage']);
});

Route::controller(VoiceController::class)->group(function () {
    Route::get('rrr/{text}', 'rrr');
});
