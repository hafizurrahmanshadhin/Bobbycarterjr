<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SurvayMarksController extends Controller {
    /**
     * Return Survey Marks Data.
     *
     * @param  int  $courseTypeId
     * @return JsonResponse
     */
    public function SurvayMarks(int $courseTypeId): JsonResponse {
        $query = Course::with(['survayQuestions.userResponses' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }]);

        if ($courseTypeId) {
            $query->where('course_type_id', $courseTypeId);
        }

        $courses = $query->get();

        $reverseScoredQuestions = [1, 2, 3, 8, 9, 11, 12, 13, 17, 18];
        $normalScoredQuestions  = [4, 5, 6, 7, 10, 14, 15, 16];
        $totalScalePoints       = 5;

        $mapOptionIdToValue = function ($optionId) {
            return ($optionId % 5) + 1;
        };

        $coursesWithMarks = $courses->map(function ($course) use ($reverseScoredQuestions, $normalScoredQuestions, $totalScalePoints, $mapOptionIdToValue) {
            $totalScore = 0;

            foreach ($course->survayQuestions as $question) {
                $questionId   = $question->id;
                $userResponse = $question->userResponses->first();

                if ($userResponse && $userResponse->option_id) {
                    $responseValue = $mapOptionIdToValue($userResponse->option_id);

                    if (in_array($questionId, $reverseScoredQuestions)) {
                        $score = ($totalScalePoints + 1) - $responseValue;
                    } elseif (in_array($questionId, $normalScoredQuestions)) {
                        $score = $responseValue;
                    } else {
                        $score = 0;
                    }

                    $totalScore += $score;

                    Log::info("Question ID: $questionId, Response Value: $responseValue, Score: $score, Total Score: $totalScore");
                } else {
                    Log::info("Question ID: $questionId has no user response or option.");
                }
            }

            return [
                'course_name' => $course->name,
                'mark'        => $totalScore,
            ];
        });

        if ($coursesWithMarks->isEmpty()) {
            return Helper::jsonResponse(true, 'Course with Mark not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Course with Mark retrieved successfully', 200, $coursesWithMarks);
    }
}
