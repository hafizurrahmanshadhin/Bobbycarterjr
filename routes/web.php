<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Frontend\AccountController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

//! Route for Reset Database and Optimize Clear
Route::get('/reset', [ResetController::class, 'RunMigrations'])->name('reset');
Route::get('/migrate', [ResetController::class, 'RunMigrate'])->name('migrate');

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/account/delete', [AccountController::class, 'deletePage'])->name('delete.account.page');
    Route::delete('/user/delete', [AccountController::class, 'userDelete'])->name('user.delete');
});

Route::get('/page/privacy-policy', [PageController::class, 'privacyAndPolicy'])->name('dynamicPage.privacyAndPolicy');
Route::get('/page/app-terms', [PageController::class, 'appTerms'])->name('dynamicPage.appTerms');

require __DIR__ . '/auth.php';
