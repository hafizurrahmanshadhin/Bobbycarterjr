<?php

use App\Http\Controllers\Api\ReminderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::controller(ReminderController::class)->group(function () {
        Route::get('/reminders', 'getAllReminders');
        Route::get('/single-reminder/{id}', 'SingleReminder');
        Route::post('/reminder/store', 'reminderStore');
        Route::delete('/reminder/delete/{id}', 'reminderDelete');
        Route::post('/reminder/update/{id}', 'reminderUpdate');
    });

});
