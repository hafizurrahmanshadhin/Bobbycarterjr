<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Option;
use App\Models\SurvayQuestion;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SurvayQuestionController extends Controller {
    /**
     * Display the list of all survey questions.
     *
     * @param Request $request
     * @return JsonResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = SurvayQuestion::with('course')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('course', function ($data) {
                    return $data->course->name ?? 'N/A';
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor  = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles     = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editQuestion(' . $data->id . ')">
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="viewQuestion(' . $data->id . ')">
                                    <i class="fe fe-eye"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['course', 'status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.survay_questions.index');
    }

    /**
     * Display the specified survey question.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function view(int $id): JsonResponse {
        try {
            $question = SurvayQuestion::with(['course', 'options'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $question]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created survey question in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        try {
            $validated = $request->validate([
                'course_id'            => 'required|exists:courses,id',
                'questions'            => 'required|string|max:255',
                'options'              => 'required|array',
                'options.*.option'     => 'required|string|max:255',
                'options.*.is_correct' => 'required|boolean',
            ]);

            $question = SurvayQuestion::create([
                'course_id' => $validated['course_id'],
                'questions' => $validated['questions'],
            ]);

            foreach ($validated['options'] as $option) {
                Option::create([
                    'survay_question_id' => $question->id,
                    'options'            => $option['option'],
                    'is_correct'         => $option['is_correct'],
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Survey question created successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all courses for dropdown selection.
     *
     * @return JsonResponse
     */
    public function getCourses(): JsonResponse {
        try {
            $courses = Course::where('status', 'active')->whereNull('deleted_at')->get();
            return response()->json(['success' => true, 'data' => $courses]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the specified survey question for editing.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse {
        try {
            $question = SurvayQuestion::with(['course', 'options'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $question]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified survey question in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse {
        try {
            $validated = $request->validate([
                'course_id'            => 'required|exists:courses,id',
                'questions'            => 'required|string|max:255',
                'options'              => 'required|array',
                'options.*.option'     => 'required|string|max:255',
                'options.*.is_correct' => 'required|boolean',
            ]);

            $question = SurvayQuestion::findOrFail($id);
            $question->update([
                'course_id' => $validated['course_id'],
                'questions' => $validated['questions'],
            ]);

            //! Delete existing options
            $question->options()->delete();

            //* Create new options
            foreach ($validated['options'] as $option) {
                Option::create([
                    'survay_question_id' => $question->id,
                    'options'            => $option['option'],
                    'is_correct'         => $option['is_correct'],
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Survey question updated successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified survey question from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $question = SurvayQuestion::find($id);
            if ($question) {
                $question->delete();
                return response()->json(['success' => true, 'message' => 'Survey question deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Survey question not found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Change the status of the specified survey question.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        try {
            $question = SurvayQuestion::findOrFail($id);

            $question->status = $question->status == 'active' ? 'inactive' : 'active';
            $question->save();

            return response()->json([
                'success' => true,
                'message' => $question->status == 'active' ? 'Published Successfully.' : 'Unpublished Successfully.',
                'data'    => $question,
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
