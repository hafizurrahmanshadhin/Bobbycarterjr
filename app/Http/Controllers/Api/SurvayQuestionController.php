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

        // $question = [];
        // $question_ids     = $request->input('question_id', []);

        // //! Convert arrays to comma-separated strings
        // $formattedQuestion_ids = str_replace(["[", "]"], '', implode(',', $question_ids));

        // $questionArray = explode(',', $formattedQuestion_ids);


        // $answer = [];
        // $answer_ids     = $request->input('answer_id', []);

        // //! Convert arrays to comma-separated strings
        // $formatetted_answer_ids = str_replace(["[", "]"], '', implode(',', $answer_ids));

        // $answerArray = explode(',', $formatetted_answer_ids);

        // // Initialize an empty array to store the user responses
        // $userResponses = [];

         // Validate the input
        //  dd($request->all());
        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer|exists:survay_questions,id',
            'answers.*.answer_id' => 'required|integer|exists:options,id',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        $userResponses = [];

        // Loop through each answer pair and store them
        foreach ($request->answers as $answer) {
            $userResponses[] = UserResponse::create([
                'user_id' => auth()->user()->id,
                'survay_question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
            ]);
        }


        // Return a JSON response with the user responses
        return Helper::jsonResponse(true, 'Answers stored successfully', 200, $userResponses);
    }
}
