<?php

use App\Console\Commands\CheckExpiredSubscriptions;
use App\Console\Commands\CheckPhpFiles;
use App\Console\Commands\SendReminders;
use Illuminate\Support\Facades\Schedule;

//! Static scheduling
Schedule::command(CheckExpiredSubscriptions::class)->everyMinute();
Schedule::command(SendReminders::class)->everyMinute();
Schedule::command('send:daily-affirmations')->everyMinute();

// whitespace check
Artisan::command('check:whitespace', function () {
    $this->call(CheckPhpFiles::class);
});

Schedule::call(function () {
    logger()->info('test it');
})->everySecond();
