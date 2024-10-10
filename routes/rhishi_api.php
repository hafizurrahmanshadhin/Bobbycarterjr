<?php

use App\Http\Controllers\Api\CourseTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;

Route::controller(SubscriptionController::class)->group(function () {
    Route::get('/package/free', 'freePackage');
    Route::get('/package/premium', 'premiumPackage');
});

Route::controller(CourseTypeController::class)->group(function () {
    Route::get('/course/types', 'CourseTypes');
});


Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/data', 'userData');
    });

});
