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
                'name'           => 'The Autonomy',
                'image_url'      => 'backend/course_image/11.jpg',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:15'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:15'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 2,
                'course_type_id' => 1,
                'name'           => 'The Environmental Mastery',
                'image_url'      => 'backend/course_image/12.jpg',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:31'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:31'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 3,
                'course_type_id' => 1,
                'name'           => 'The Personal Growth',
                'image_url'      => 'backend/course_image/13.jpg',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:43'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:43'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 4,
                'course_type_id' => 1,
                'name'           => 'The Positive Relations with Others',
                'image_url'      => 'backend/course_image/14.jpg',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:02:52'),
                'updated_at'     => Carbon::parse('2024-10-10 23:02:52'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 5,
                'course_type_id' => 1,
                'name'           => 'The Purpose in Life',
                'image_url'      => 'backend/course_image/11.jpg',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:03:01'),
                'updated_at'     => Carbon::parse('2024-10-10 23:03:01'),
                'deleted_at'     => null,
            ],
            [
                'id'             => 6,
                'course_type_id' => 1,
                'name'           => 'The Self-Acceptance',
                'image_url'      => 'backend/course_image/13.jpg',
                'status'         => 'active',
                'created_at'     => Carbon::parse('2024-10-10 23:03:11'),
                'updated_at'     => Carbon::parse('2024-10-10 23:03:11'),
                'deleted_at'     => null,
            ],
        ]);
    }
}
