<?php

use App\Console\Commands\CheckExpiredSubscriptions;
use App\Console\Commands\SendDailyAffirmations;

Schedule::command(CheckExpiredSubscriptions::class)->daily();

Schedule::command(SendDailyAffirmations::class)->dailyAt('08:00');
Schedule::command(SendDailyAffirmations::class)->dailyAt('12:00');
Schedule::command(SendDailyAffirmations::class)->dailyAt('18:00');
