<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\SurvayQuestion;
use App\Models\UserRecommended;
use App\Models\UserResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SurvayQuestionController extends Controller
{
    /**
     * Return SurvayQuestion Data.
     *
     * @param  int  $course_type_id
     * @return JsonResponse
     */

     public function SurvayQuestion(int $course_type_id) : JsonResponse {

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
     * @param  Request  $request
     * @return JsonResponse
     */

    public function SurvayQuestionAnswer_store(Request $request, $courseTypeId) {

        $validator = Validator::make($request->all(), [
            'answers' => 'required|array|min:1',
            'answers.*.question_id' => 'required|integer|exists:survay_questions,id',
            'answers.*.answer_id' => 'required|integer|exists:options,id',
        ], [
            'answers.required' => 'The answers field is required.',
            'answers.*.question_id.required' => 'The question field is required.',
            'answers.*.answer_id.required' => 'The answer field is required.',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        DB::beginTransaction();

        try {

            $userResponses = [];

            // Loop through each answer pair and store them
            foreach ($request->answers as $answer) {
                $userResponses[] = UserResponse::create([
                    'user_id' => auth()->user()->id,
                    'survay_question_id' => $answer['question_id'],
                    'option_id' => $answer['answer_id'],
                ]);
            }

            $courseWithMarks = $this->calculateCourseMarks($courseTypeId);

            // Get the 2 courses with the lowest marks
            $lowestMarkCourses = $courseWithMarks->sortBy('mark')->take(2);

            $lowestCourseMark = [];

            foreach($lowestMarkCourses as $item) {

                $lowestCourseMark[] = UserRecommended::create([
                    'user_id' => auth()->id(),
                    'course_id' => $item['course_id']
                ]);
            }

            DB::commit();
            return Helper::jsonResponse(true, 'Answers stored successfully', 200, $userResponses);
        } catch (\Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'An error occurred while processing your request.', 500, $e->getMessage());
        }
    }

    private function calculateCourseMarks(int $courseTypeId) {
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
                'course_id' => $course->id
            ];

        });

        return $coursesWithMarks;
    }
}
