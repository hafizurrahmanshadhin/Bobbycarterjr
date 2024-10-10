<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
    /**
     * Return Course Type Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

     public function CourseTypes() {

        $data = CourseType::where('status', 'active')->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Course Types not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Course Types retrieved successfully', 200, $data);
    }
}
