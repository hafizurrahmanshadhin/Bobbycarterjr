<?php

namespace App\Http\Controllers\api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseModuleController extends Controller
{

    /**
     * Return Course Module Under a Course Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function courseModule(int $course_id) {

        $data = Module::where('course_id', $course_id)->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Course Module not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Course Module retrieved successfully', 200, $data);
    }

    /**
     * Return Single Module Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function courseSingleModule(int $id) {

        $data = Module::where('id', $id)->first();

        // Check if the Course Types was found
        if ($data === null) {
            return Helper::jsonResponse(true, 'Course Module not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Course Module retrieved successfully', 200, $data);
    }
}
