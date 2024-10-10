<?php

use App\Http\Controllers\Web\Backend\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::controller(SubscriptionController::class)->name('admin.')->group(function () {
    Route::get('/subscription', 'index')->name('subscription.index');
    Route::get('/subscription/edit/{id}', 'edit')->name('subscription.edit');
    Route::post('/subscription/update/{id}', 'update')->name('subscription.update');
});
