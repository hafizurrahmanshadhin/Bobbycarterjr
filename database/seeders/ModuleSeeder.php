<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::insert([
            [
                'course_id' => 1,
                'title' => 'Introduction to Programming',
                'content' => 'This module introduces the basics of programming.',
                'is_exam' => false,
                'question' => null,
                'mark' => 10,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Advanced Programming Techniques',
                'content' => 'This module covers advanced programming techniques.',
                'is_exam' => false,
                'question' => null,
                'mark' => 5,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'title' => 'Database Management',
                'content' => null,
                'is_exam' => true,
                'question' => 'What is normalization?',
                'mark' => 15,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 3,
                'title' => 'Web Development Basics',
                'content' => 'An introduction to HTML, CSS, and JavaScript.',
                'is_exam' => false,
                'question' => null,
                'mark' => 20,
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
