<?php

use App\Http\Controllers\Web\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('welcome');

require __DIR__ . '/auth.php';
