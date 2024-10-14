<?php

use App\Http\Controllers\web\Backend\CourseModuleController;
use App\Http\Controllers\Web\Backend\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::controller(SubscriptionController::class)->name('admin.')->group(function () {
    Route::get('/subscription', 'index')->name('subscription.index');
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
