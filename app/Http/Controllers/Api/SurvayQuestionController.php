<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\SurvayQuestion;
use App\Models\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurvayQuestionController extends Controller
{
    /**
     * Return SurvayQuestion Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

     public function SurvayQuestion(int $course_type_id) {

        // Retrieve active course IDs for the given course type
        $courseIds = Course::where('course_type_id', $course_type_id)
        ->where('status', 'active')
        ->pluck('id');

        // Get active survey questions for those course IDs
        $data = SurvayQuestion::query()
            ->with('options')
            ->whereIn('course_id', $courseIds)
            ->where('status', 'active')
            ->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Survay Question not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Survay Question retrieved successfully', 200, $data);
    }

    /**
     * Return SurvayQuestion Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function SurvayQuestionAnswer_store(Request $request) {

        $amenitiesData = [];
        $amenities     = $request->input('amenities', []);

        $validator = Validator::make($request->all(), [
            'question_id' => 'required|array',
            'question_id.*' => 'integer|exists:survay_questions,id', // Validate each question_id
            'answer_id' => 'required|array',
            'answer_id.*' => 'integer|exists:options,id' // Validate each answer_id
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        $userResponses = [];

        foreach ($request->answer_id as $answer) {
            $userResponses[] = UserResponse::create([
                'user_id' => auth()->user()->id,
                'survay_question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
            ]);
        }

        return Helper::jsonResponse(true, 'Answers stored successfully', 200, $userResponses);
    }
}
