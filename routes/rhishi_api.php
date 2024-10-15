<?php

use App\Http\Controllers\api\ArticleController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\api\CourseModuleController;
use App\Http\Controllers\Api\CourseTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\SurvayMarksController;
use App\Http\Controllers\Api\SurvayQuestionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoiceController;

Route::controller(SubscriptionController::class)->group(function () {
    Route::get('/package/free', 'freePackage');
    Route::get('/package/premium', 'premiumPackage');
});

Route::controller(VoiceController::class)->group(function () {
    Route::get('rrr/{text}', 'rrr');
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
        Route::get('/recommend/course/{course_type_id}', 'recommendCourse');
    });

    Route::controller(SurvayQuestionController::class)->group(function () {
        Route::get('/survay/questions/{course_type_id}', 'SurvayQuestion');
        Route::post('/survay/questions/answer/store', 'SurvayQuestionAnswer_store');
    });

    Route::controller(SurvayMarksController::class)->group(function () {
        Route::get('/survay/marks/{course_type_id}', 'SurvayMarks');
    });

    Route::controller(CourseModuleController::class)->group(function () {
        Route::get('/course/module/{id}', 'courseModule');
        Route::get('/course/single-module/{id}', 'courseSingleModule');
        Route::post('/course/module/answer/store/{module_id}', 'courseModuleAnswerStore');
    });

    Route::controller(ArticleController::class)->group(function () {
        Route::get('/course/article/{course_id}', 'courseArticle');
        Route::get('/course/daily-read/article/{course_id}', 'courseDailyReadArticle');
        Route::get('/course/single-article/{id}', 'courseSingleArticle');
    });

});
