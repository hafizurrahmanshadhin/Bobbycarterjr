<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UserRecommended;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller {
    /**
     * Return Courses Data.
     *
     * @return JsonResponse
     */
    public function Course(): JsonResponse {

        $data = Course::query()
            ->with('modules:id,course_id,audio_time')
            ->where('status', 'active')
            ->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Course not found', 200, []);
        }

        $responses = $data->map(function ($course) {
            $totalAudioTime = $course->modules->sum('audio_time');
            return [
                'id'             => $course->id,
                'course_type_id' => $course->course_type_id,
                'name'           => $course->name,
                'image_url'      => $course->image_url,
                'modules_count'  => count($course->modules),
                'course_time'    => $this->formatAudioTimeToMinutes($totalAudioTime),
            ];
        });

        return Helper::jsonResponse(true, 'Course retrieved successfully', 200, $responses);
    }

    private function formatAudioTimeToMinutes($seconds) {
        $minutes = floor($seconds / 60);
        return sprintf('%d', $minutes);
    }

    /**
     * Return Courses Data.
     *
     * @return JsonResponse
     */
    public function recommendCourse() {

        $data = UserRecommended::query()
            ->with('course', 'course.modules:id,course_id,audio_time') // Eager load course with audio_time
            ->where('user_id', Auth::id())
            ->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Recommend Course Not found', 200, []);
        }

        $responses = $data->map(function ($recommendation) {
            $totalAudioTime = $recommendation->course->modules->sum('audio_time');
            return [
                'id'        => $recommendation->id,
                'user_id'   => $recommendation->user_id,
                'course_id' => $recommendation->course_id,
                'course'    => [
                    'id'             => $recommendation->course->id,
                    'course_type_id' => $recommendation->course->course_type_id,
                    'name'           => $recommendation->course->name,
                    'image_url'      => $recommendation->course->image_url,
                    'modules_count'  => count($recommendation->course->modules), // Use the count directly
                    'course_time' => $this->formatAudioTimeToMinutes($totalAudioTime),
                ],
            ];
        });

        return Helper::jsonResponse(true, 'Recommend Course retrieved successfully', 200, $responses);
    }
}
