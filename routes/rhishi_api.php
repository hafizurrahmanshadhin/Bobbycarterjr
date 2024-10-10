<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscriptionController;


Route::controller(SubscriptionController::class)->group(function () {
    Route::post('/package/free', 'freePackage');
    Route::post('/package/premium', 'premiumPackage');
});
