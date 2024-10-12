<?php

use App\Http\Controllers\Web\Backend\CourseController;
use App\Http\Controllers\Web\Backend\CourseTypeController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\SurvayQuestionController;
use Illuminate\Support\Facades\Route;

//! Route for Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//! Route for CourseTypeController
Route::controller(CourseTypeController::class)->group(function () {
    Route::get('/course-type', 'index')->name('course-type.index');
    Route::post('/course-type/store', 'store')->name('course-type.store');
    Route::get('/course-type/edit/{id}', 'edit')->name('course-type.edit');
    Route::put('/course-type/update/{id}', 'update')->name('course-type.update');
    Route::get('/course-type/status/{id}', 'status')->name('course-type.status');
    Route::delete('/course-type/destroy/{id}', 'destroy')->name('course-type.destroy');
});

//! Route for CourseController
Route::controller(CourseController::class)->group(function () {
    Route::get('/course', 'index')->name('course.index');
    Route::get('course-types/list', 'getCourseTypes')->name('course-types.list');
    Route::post('/course/store', 'store')->name('course.store');
    Route::get('/course/edit/{id}', 'edit')->name('course.edit');
    Route::put('/course/update/{id}', 'update')->name('course.update');
    Route::get('/course/status/{id}', 'status')->name('course.status');
    Route::delete('/course/destroy/{id}', 'destroy')->name('course.destroy');
});

//! Route for SurvayQuestionController
Route::controller(SurvayQuestionController::class)->prefix('survay-questions')->group(function () {
    Route::get('/', 'index')->name('survay-questions.index');
    Route::post('/', 'store')->name('survay-questions.store');
    Route::get('/{id}', 'edit')->name('survay-questions.edit');
    Route::put('/{id}', 'update')->name('survay-questions.update');
    Route::delete('/{id}', 'destroy')->name('survay-questions.destroy');
    Route::get('/status/{id}', 'status')->name('survay-questions.status');
    Route::get('/view/{id}', 'view')->name('survay-questions.view');

    //* Courses List Route for Dropdown
    Route::get('/courses/list', 'getCourses')->name('courses.list');
});
