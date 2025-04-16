<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

//! Route for Reset Database and Optimize Clear
Route::get('/reset', [ResetController::class, 'RunMigrations'])->name('reset');

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::get('/page/privacy-policy', [PageController::class, 'privacyAndPolicy'])->name('dynamicPage.privacyAndPolicy');
Route::get('/page/app-terms', [PageController::class, 'appTerms'])->name('dynamicPage.appTerms');

require __DIR__ . '/auth.php';
