<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Return Courses Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

     public function Course() {

        $data = Course::where('status', 'active')->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Course not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Course retrieved successfully', 200, $data);
    }

    /**
     * Return Courses Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function recommendCourse(int $courseTypeId) {
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
                'mark' => $correctAnswers,
                'course_id' => $course->id, // Include course_id if needed for details
            ];
        });

        // Get the 2 courses with the lowest marks
        $lowestMarkCourses = $coursesWithMarks->sortBy('mark')->take(2);

        // Convert to array if needed
        $lowestMarkCoursesArray = $lowestMarkCourses->values()->toArray();

        // Return or use $lowestMarkCoursesArray as needed
        return $lowestMarkCoursesArray;

    }
}
