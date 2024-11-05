<?php

use App\Http\Controllers\Web\Backend\ArticleController;
use App\Http\Controllers\Web\Backend\CourseModuleController;
use App\Http\Controllers\Web\Backend\DailyAffirmationController;
use App\Http\Controllers\Web\Backend\SubscriptionController;
use App\Http\Controllers\Web\Backend\TaskAnswersController;
use App\Http\Controllers\Web\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(SubscriptionController::class)->name('admin.')->group(function () {
    Route::get('/subscription', 'index')->name('subscription.index');
    Route::get('/subscription/single/{id}', 'single')->name('subscription.single');
    Route::get('/subscription/edit/{id}', 'edit')->name('subscription.edit');
    Route::post('/subscription/update/{id}', 'update')->name('subscription.update');
});

Route::controller(CourseModuleController::class)->name('admin.')->group(function () {
    Route::get('/course/modules', 'index')->name('course.module.index');
    Route::get('/course/module/create', 'create')->name('course.module.create');
    Route::post('/course/module/store', 'store')->name('course.module.store');
    Route::get('/course/module/edit/{id}', 'edit')->name('course.module.edit');
    Route::post('/course/module/update/{id}', 'update')->name('course.module.update');
    Route::post('/course/module/status/{id}', 'status')->name('course.module.status');
    Route::post('/course/module/destroy/{id}', 'destroy')->name('course.module.destroy');
    Route::get('/course/module/single/{id}', 'single')->name('course.module.single');

    Route::post('/course/modules/sort', 'sort')->name('course.module.sort');
});

Route::controller(ArticleController::class)->name('admin.')->group(function () {
    Route::get('/articles', 'index')->name('article.index');
    Route::get('/article/create', 'create')->name('article.create');
    Route::post('/article/store', 'store')->name('article.store');
    Route::get('/article/edit/{id}', 'edit')->name('article.edit');
    Route::post('/article/update/{id}', 'update')->name('article.update');
    Route::post('/article/status/{id}', 'status')->name('article.status');
    Route::post('/article/destroy/{id}', 'destroy')->name('article.destroy');
});

//! Route for SurvayQuestionController
Route::controller(TaskAnswersController::class)->name('admin.')->group(function () {
    Route::get('/task-answers', 'index')->name('task_answer.index');
    Route::get('/task-answer/single/{id}', 'single')->name('survay-question.single');
});

//! Route for SurvayQuestionController
Route::controller(DailyAffirmationController::class)->name('admin.')->group(function () {
    Route::get('/daily-affirmation', 'index')->name('daily_affirmation.index');
    Route::get('/daily-affirmation/{id}', 'single')->name('daily_affirmation.single');
    Route::post('/daily-affirmation/update', 'update')->name('daily_affirmation.update');
});

//! Route for SurvayQuestionController
Route::controller(UserController::class)->name('admin.')->group(function () {
    Route::get('/users', 'index')->name('user.index');
    Route::post('/user/status/{id}', 'status')->name('user.status');
});
