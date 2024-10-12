<?php

namespace Database\Seeders;

use App\Models\SurvayQuestion;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurvayQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to seed with specific created_at timestamps
        $questions = [
            [
                'course_id' => 1, // Ensure this course_id exists in the courses table
                'questions' => 'What did you like most about this course?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(10), // 10 days ago
            ],
            [
                'course_id' => 1,
                'questions' => 'What could be improved in this course?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(9), // 9 days ago
            ],
            [
                'course_id' => 1,
                'questions' => 'How would you rate the instructor’s teaching?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(8), // 8 days ago
            ],
            [
                'course_id' => 2, // Ensure this course_id exists in the courses table
                'questions' => 'How would you rate the course materials?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(7), // 7 days ago
            ],
            [
                'course_id' => 2,
                'questions' => 'Would you recommend this course to others?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(6), // 6 days ago
            ],
            [
                'course_id' => 2,
                'questions' => 'Was the course duration adequate?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(5), // 5 days ago
            ],
            [
                'course_id' => 3, // Ensure this course_id exists in the courses table
                'questions' => 'What additional topics would you like covered?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(4), // 4 days ago
            ],
            [
                'course_id' => 3,
                'questions' => 'How helpful were the assignments?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(3), // 3 days ago
            ],
            [
                'course_id' => 3,
                'questions' => 'Did you find the course engaging?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(2), // 2 days ago
            ],
            [
                'course_id' => 1,
                'questions' => 'Any other feedback you would like to provide?',
                'status'    => 'active',
                'created_at' => Carbon::now()->subDays(1), // 1 day ago
            ],
        ];

        // Insert data into the survay_questions table
        SurvayQuestion::insert($questions);
    }
}
