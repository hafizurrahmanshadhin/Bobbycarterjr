<?php

use App\Http\Controllers\Web\Backend\CourseTypeController;
use App\Http\Controllers\Web\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// !Route for PropertySettingsController
Route::controller(CourseTypeController::class)->group(function () {
    Route::get('/course-type', 'index')->name('course-type.index');
    Route::post('/course-type/store', 'store')->name('course-type.store');
    Route::get('/course-type/edit/{id}', 'edit')->name('course-type.edit');
    Route::put('/course-type/update/{id}', 'update')->name('course-type.update');
    Route::get('/course-type/status/{id}', 'status')->name('course-type.status');
    Route::delete('/course-type/destroy/{id}', 'destroy')->name('course-type.destroy');
});
