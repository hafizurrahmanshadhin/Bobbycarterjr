<?php

use App\Console\Commands\CheckExpiredSubscriptions;
use App\Console\Commands\SendDailyAffirmations;
use App\Console\Commands\SendReminders;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CheckExpiredSubscriptions::class)->daily();

Schedule::command(SendDailyAffirmations::class)->dailyAt('08:00');
Schedule::command(SendDailyAffirmations::class)->dailyAt('12:00');
Schedule::command(SendDailyAffirmations::class)->dailyAt('18:00');

// Schedule::command(SendDailyAffirmations::class)->everyMinute();

// Schedule::command('send:reminders')->everyMinute();
Schedule::command(SendReminders::class)->everyMinute();
