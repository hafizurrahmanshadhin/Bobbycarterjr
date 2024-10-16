<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UserRecommended;
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

    public function recommendCourse() {

        $data = UserRecommended::with('course')->where('user_id', auth()->id())->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Recommend Course Not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Recommend Course retrieved successfully', 200, $data);
    }
}
