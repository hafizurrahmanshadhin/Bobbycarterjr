<?php

namespace Database\Seeders;

use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example options for the survey questions
        $options = [
            // Options for question ID 1
            [
                'survay_question_id' => 1, // "What did you like most about this course?"
                'options'            => 'The content was very informative.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 1,
                'options'            => 'The instructor was engaging.',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 1,
                'options'            => 'The assignments were helpful.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 1,
                'options'            => 'The pacing was good.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 2
            [
                'survay_question_id' => 2, // "What could be improved in this course?"
                'options'            => 'More interactive sessions.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 2,
                'options'            => 'Fewer assignments.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 2,
                'options'            => 'Longer course duration.',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 2,
                'options'            => 'More resources provided.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 3
            [
                'survay_question_id' => 3, // "How would you rate the instructor’s teaching?"
                'options'            => 'Excellent',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 3,
                'options'            => 'Good',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 3,
                'options'            => 'Average',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 3,
                'options'            => 'Poor',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 4
            [
                'survay_question_id' => 4, // "How would you rate the course materials?"
                'options'            => 'Very useful',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 4,
                'options'            => 'Somewhat useful',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 4,
                'options'            => 'Not useful at all',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 5
            [
                'survay_question_id' => 5, // "Would you recommend this course to others?"
                'options'            => 'Definitely',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 5,
                'options'            => 'Maybe',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 5,
                'options'            => 'No',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 6
            [
                'survay_question_id' => 6, // "Was the course duration adequate?"
                'options'            => 'Yes',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 6,
                'options'            => 'Too short',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 6,
                'options'            => 'Too long',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 7
            [
                'survay_question_id' => 7, // "What additional topics would you like covered?"
                'options'            => 'Advanced techniques',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 7,
                'options'            => 'Real-world applications',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 7,
                'options'            => 'Latest trends',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 8
            [
                'survay_question_id' => 8, // "How helpful were the assignments?"
                'options'            => 'Very helpful',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 8,
                'options'            => 'Somewhat helpful',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 8,
                'options'            => 'Not helpful',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 9
            [
                'survay_question_id' => 9, // "Did you find the course engaging?"
                'options'            => 'Yes, very engaging',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 9,
                'options'            => 'Somewhat engaging',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 9,
                'options'            => 'Not engaging',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],

            // Options for question ID 10
            [
                'survay_question_id' => 10, // "Any other feedback you would like to provide?"
                'options'            => 'Great experience overall.',
                'is_correct'         => true,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 10,
                'options'            => 'Looking forward to more courses.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'survay_question_id' => 10,
                'options'            => 'I didn’t enjoy it.',
                'is_correct'         => false,
                'status'             => 'active',
                'created_at' => Carbon::now()
            ],
        ];

        // Insert data into the options table
        Option::insert($options);
    }
}
