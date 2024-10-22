<?php

use App\Console\Commands\CheckExpiredSubscriptions;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::command(CheckExpiredSubscriptions::class)->hourly();
// Schedule::command(CheckExpiredSubscriptions::class)->everyMinute();
Schedule::command(CheckExpiredSubscriptions::class)->daily();
