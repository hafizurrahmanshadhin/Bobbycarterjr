<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('course_types')->insert([
            [
                'id'         => 1,
                'name'       => 'Psychological Wellbeing',
                'image'      => 'frontend/Psychological_Wellbeing.png',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '10', '10', '03', '57', '04'),
                'updated_at' => Carbon::create('2024', '10', '10', '03', '57', '04'),
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'name'       => 'Psychological Capital',
                'image'      => 'frontend/Psychological_Capital.png',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '10', '10', '03', '57', '27'),
                'updated_at' => Carbon::create('2024', '10', '10', '03', '57', '27'),
                'deleted_at' => null,
            ],
        ]);
    }
}
