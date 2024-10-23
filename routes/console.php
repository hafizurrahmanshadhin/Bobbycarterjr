<?php

use App\Console\Commands\CheckExpiredSubscriptions;
use App\Console\Commands\SendDailyAffirmations;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(CheckExpiredSubscriptions::class)->daily();

Schedule::command(SendDailyAffirmations::class)->dailyAt('08:00');
Schedule::command(SendDailyAffirmations::class)->dailyAt('12:00');
Schedule::command(SendDailyAffirmations::class)->dailyAt('18:00');
