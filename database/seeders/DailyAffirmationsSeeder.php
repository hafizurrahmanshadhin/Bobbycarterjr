<?php

namespace Database\Seeders;

use App\Models\DailyAffirmation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DailyAffirmationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DailyAffirmation::insert([
            'notification' => "You're doing wonderfully! Your efforts are truly paying off. Keep up the great work—you're making amazing progress!",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
