<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class SurvayMarksController extends Controller
{
    public function SurvayMarks(int $courseTypeId)
    {
        $query = Course::with(['survayQuestions.options', 'survayQuestions.userResponses' => function($query) {
            $query->where('user_id', auth()->user()->id);
        }]);

        if ($courseTypeId) {
            $query->where('course_type_id', $courseTypeId);
        }

        $courses = $query->get();

        $coursesWithMarks = $courses->map(function ($course) {
            $correctAnswers = $course->survayQuestions->flatMap(function ($question) {
                return $question->userResponses->map(function ($response) {
                    return $response->option->is_correct;
                });
            })->filter()->count();

            return [
                'course_name' => $course->name,
                'mark' => $correctAnswers
            ];
        });

        // Check if the Course Types was found
        if ($coursesWithMarks->isEmpty()) {
            return Helper::jsonResponse(true, 'Course with Mark not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Course with Mark retrieved successfully', 200, $coursesWithMarks);
    }

}
