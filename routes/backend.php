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
// Route::controller(SurvayQuestionController::class)->group(function () {
//     Route::get('/survay-questions', 'index')->name('survay-questions.index');
//     Route::post('/survay-questions/store', 'store')->name('survay-questions.store');
//     Route::get('/survay-questions/edit/{id}', 'edit')->name('survay-questions.edit');
//     Route::put('/survay-questions/update/{id}', 'update')->name('survay-questions.update');
//     Route::get('/survay-questions/status/{id}', 'status')->name('survay-questions.status');
//     Route::delete('/survay-questions/destroy/{id}', 'destroy')->name('survay-questions.destroy');
// });


// Survey Questions Routes
Route::prefix('survay-questions')->group(function () {
    Route::get('/', [SurvayQuestionController::class, 'index'])->name('survay-questions.index');
    Route::post('/', [SurvayQuestionController::class, 'store'])->name('survay-questions.store');
    Route::get('/{id}', [SurvayQuestionController::class, 'edit'])->name('survay-questions.edit');
    Route::put('/{id}', [SurvayQuestionController::class, 'update'])->name('survay-questions.update');
    Route::delete('/{id}', [SurvayQuestionController::class, 'destroy'])->name('survay-questions.destroy');
    Route::get('/status/{id}', [SurvayQuestionController::class, 'status'])->name('survay-questions.status');
});

// Courses List Route for Dropdown
Route::get('/courses/list', [SurvayQuestionController::class, 'getCourses'])->name('courses.list');
