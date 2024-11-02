<?php

use App\Console\Commands\CheckExpiredSubscriptions;
use App\Console\Commands\SendReminders;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;

//! Static scheduling
Schedule::command(CheckExpiredSubscriptions::class)->daily();
Schedule::command(SendReminders::class)->everyMinute();

//* Dynamic scheduling based on user-specified notification times
// Schedule::call(function () {
//     //! Retrieve unique notification times from `user_affirmations`
//     $uniqueNotificationTimes = UserAffirmation::whereNotNull('notification_time')
//         ->distinct()
//         ->pluck('notification_time');

//     foreach ($uniqueNotificationTimes as $time) {
//         Schedule::command(SendDailyAffirmations::class, [$time])->dailyAt($time);
//     }
// });

// Run the SendDailyAffirmations command every minute, checking for matching notification times
Schedule::command('send:daily-affirmations', [Carbon::now()->format('H:i')])->everyMinute();
