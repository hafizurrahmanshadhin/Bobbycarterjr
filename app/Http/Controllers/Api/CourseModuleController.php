<?php

namespace App\Http\Controllers\api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Module;
use App\Rules\AtLeastOneRequired;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Store Module question answer.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

     public function courseModuleAnswerStore(Request $request, int $id) {

        $validator = Validator::make($request->all(), [
            'url' => $request->input('answer') ? 'nullable|url' : 'required|url',
            'answer' => $request->input('url') ? 'nullable|string' : 'required|string',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {
            $data = Answer::create([
                'module_id' => $id,
                'url' => $request->url,
                'answer' => $request->answer,
            ]);

            return Helper::jsonResponse(true, 'Course Module Answer Store Successful', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error occurred: ' . $e->getMessage(), 500);
        }
    }
}
