<?php

use App\Console\Commands\CheckExpiredSubscriptions;
use App\Console\Commands\SendReminders;
use Illuminate\Support\Facades\Schedule;

//! Static scheduling
Schedule::command(CheckExpiredSubscriptions::class)->daily();
Schedule::command(SendReminders::class)->everyMinute();
Schedule::command('send:daily-affirmations')->everyMinute();
