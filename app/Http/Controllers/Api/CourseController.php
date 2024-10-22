<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UserRecommended;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Return Courses Data.
     *
     * @return JsonResponse
     */

     public function Course() : JsonResponse{

        $data = Course::query()
                ->with('modules:id,course_id')
                ->where('status', 'active')
                ->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Course not found', 200, []);
        }

        $responses = $data->map(function ($course) {
            return [
                'id' => $course->id,
                'course_type_id' => $course->course_type_id,
                'name' => $course->name,
                'image_url' => $course->image_url,
                'modules_count' => count($course->modules),
            ];
        });

        return Helper::jsonResponse(true, 'Course retrieved successfully', 200, $responses);
    }

    /**
     * Return Courses Data.
     *
     * @return JsonResponse
     */

    public function recommendCourse() {

        $data = UserRecommended::query()
                ->with('course', 'course.modules:id,course_id') // Eager load course
                ->where('user_id', Auth::id())
                ->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Recommend Course Not found', 200, []);
        }

        $responses = $data->map(function ($recommendation) {
            return [
                'id' => $recommendation->id,
                'user_id' => $recommendation->user_id,
                'course_id' => $recommendation->course_id,
                'course' => [
                    'id' => $recommendation->course->id,
                    'course_type_id' => $recommendation->course->course_type_id,
                    'name' => $recommendation->course->name,
                    'image_url' => $recommendation->course->image_url,
                    'modules_count' => count($recommendation->course->modules), // Use the count directly
                ],
            ];
        });

        return Helper::jsonResponse(true, 'Recommend Course retrieved successfully', 200, $responses);
    }
}
