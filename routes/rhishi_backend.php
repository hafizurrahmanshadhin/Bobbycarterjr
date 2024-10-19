<?php

use App\Http\Controllers\Web\Backend\ArticleController;
use App\Http\Controllers\Web\Backend\CourseModuleController;
use App\Http\Controllers\Web\Backend\SubscriptionController;
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
