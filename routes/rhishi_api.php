<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscriptionController;


Route::controller(SubscriptionController::class)->group(function () {
    Route::get('/package/free', 'freePackage');
    Route::get('/package/premium', 'premiumPackage');
});
