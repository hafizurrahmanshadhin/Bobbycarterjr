<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('courses')->insert([
            [
                'id'             => 1,
                'course_type_id' => 1,
                'name'           => 'Autonomy',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:15'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:15'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 2,
                'course_type_id' => 1,
                'name'           => 'Self Acceptance',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:31'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:31'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 3,
                'course_type_id' => 1,
                'name'           => 'Environmental Mastery',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:43'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:43'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 4,
                'course_type_id' => 1,
                'name'           => 'Positive Relationship',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:52'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:52'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 5,
                'course_type_id' => 1,
                'name'           => 'Personal Growth',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:03:01'),
                'updated_at'     => Carbon::parse('2024-10-10 23:03:01'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 6,
                'course_type_id' => 1,
                'name'           => 'Purpose in Life',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:03:11'),
                'updated_at'     => Carbon::parse('2024-10-10 23:03:11'),
                'deleted_at'     => null,
            ],
        ]);
    }
}
