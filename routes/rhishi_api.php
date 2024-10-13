<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\SurvayMarksController;
use App\Http\Controllers\Api\SurvayQuestionController;
use App\Http\Controllers\Api\UserController;

Route::controller(SubscriptionController::class)->group(function () {
    Route::get('/package/free', 'freePackage');
    Route::get('/package/premium', 'premiumPackage');
});

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/data', 'userData');
        Route::post('/user/update/{id}', 'userUpdate');
        Route::post('/user/password/update', 'updatePassword');
        Route::delete('/user/delete', 'userDelete');
    });

    Route::controller(CourseTypeController::class)->group(function () {
        Route::get('/course/types', 'CourseTypes');
    });

    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'Course');
    });

    Route::controller(SurvayQuestionController::class)->group(function () {
        Route::get('/survay/questions/{course_type_id}', 'SurvayQuestion');
        Route::post('/survay/questions/answer/store', 'SurvayQuestionAnswer_store');
    });

    Route::controller(SurvayMarksController::class)->group(function () {
        Route::get('/survay/marks/{course_type_id}', 'SurvayMarks');
    });

});
