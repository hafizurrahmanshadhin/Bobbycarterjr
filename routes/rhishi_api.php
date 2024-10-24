<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseModuleController;
use App\Http\Controllers\Api\CourseTypeController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\SurvayMarksController;
use App\Http\Controllers\Api\SurvayQuestionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('/package/free', 'freePackage');
        Route::get('/package/premium', 'premiumPackage');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/data', 'userData');
        Route::post('/user/update/{id}', 'userUpdate');
        Route::post('/user/password/update', 'updatePassword');
        Route::delete('/user/delete', 'userDelete');

        Route::post('/generate-link/{user_id}', [UserController::class, 'GenerateLink']);
    });

    Route::controller(CourseTypeController::class)->group(function () {
        Route::get('/course/types', 'CourseTypes');
    });

    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'Course');
        Route::get('/recommend/course', 'recommendCourse');
    });

    Route::controller(SurvayQuestionController::class)->group(function () {
        Route::get('/survay/questions/{course_type_id}', 'SurvayQuestion');
        Route::post('/survay/questions/answer/store/{course_type_id}', 'SurvayQuestionAnswer_store');
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

    Route::controller(JournalController::class)->group(function () {
        Route::get('/journals', 'getAllJournals');
        Route::get('/single-journal/{id}', 'SingleJournal');
        Route::post('/journal/store', 'journalStore');
        Route::delete('/journal/delete/{id}', 'journalDelete');
        Route::post('/journal/update/{id}', 'journalUpdate');
    });

    Route::controller(BookmarkController::class)->group(function () {
        Route::post('/bookmark/toggle', 'toggleBookmark');
        Route::get('/bookmarks', 'getBookmarks');
    });

    Route::controller(StatisticsController::class)->group(function () {
        Route::post('/module/complete/{module_id}', 'completeModule');
        Route::get('/module/status/{course_id}', 'moduleStatus');
        Route::get('/specific/module/status/{course_id}', 'specificModuleStatus');

        Route::get('/specific/task/status/{course_id}', 'specificTaskStatus');

        Route::post('/article/complete/{article_id}', 'completeArticle');
        Route::get('/article/status/{course_id}', 'articleStatus');

        Route::get('/completed/task/{course_id}', 'completedTask');
        Route::get('/completed/module/{course_id}', 'completedModule');
        Route::get('/completed/article/{course_id}', 'completedArticle');
        Route::get('/completed/all/{course_id}', 'allCompleted');
    });

});
