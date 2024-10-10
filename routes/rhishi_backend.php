<?php

use App\Http\Controllers\Web\Backend\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::get('/subscription', [SubscriptionController::class, 'index'])->name('admin.subscription.index');
Route::get('/subscription/edit/{id}', [SubscriptionController::class, 'edit'])->name('admin.subscription.edit');
Route::post('/subscription/update/{id}', [SubscriptionController::class, 'update'])->name('admin.subscription.update');
