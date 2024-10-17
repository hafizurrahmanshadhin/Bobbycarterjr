<?php

namespace App\Http\Controllers\web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CourseModuleController extends Controller
{
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = Module::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('course_name', function ($data) {
                    return $data->course->name;
                })
                ->addColumn('content', function ($data) {
                    $page_content       = $data->content;
                    $short_page_content = strlen($page_content) > 100 ? substr($page_content, 0, 100) . '...' : $page_content;
                    return '<p>' . $short_page_content . ' </p>';
                })
                ->addColumn('question', function ($data) {
                    $page_content       = $data->question;
                    $short_page_content = strlen($page_content) > 100 ? substr($page_content, 0, 100) . '...' : $page_content;
                    return '<p>' . $short_page_content . ' </p>';
                })
                ->addColumn('module', function ($data) {
                    return $data->is_exam == 1 ? "<span class='badge bg-primary'>Question Module</span>" : '';
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
                                <a href="' . route('admin.course.module.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['course_name', 'status', 'content', 'module', 'question', 'action'])
                ->make();
        }
        return view('backend.layouts.module.index');
    }

    public function create() {
        $course = Course::where('status', 'active')->get();
        return view('backend.layouts.module.create', compact('course'));
    }

    public function store(Request $request) {
        // Determine validation rules based on the checkbox input
        $rules = [
            'course_name' => 'required|numeric|exists:courses,id',
            'mark' => 'required|numeric',
            'title' => 'required|string',
            'description' => $request->input('is_exam') ? 'nullable|string' : 'required|string',
            'question' => $request->input('is_exam') ? 'required|string' : 'nullable|string',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        try {
            $module = new Module();

            $module->course_id = $request->course_name;

            // Assign values based on request
            $module->title = $request->title ?? null;  // Use null coalescing for clarity

            if ($request->is_exam) {
                $module->question = $request->input('question') ?? null;
            } else {
                $module->content = $request->input('description') ?? null;
            }

            $module->is_exam = $request->input('is_exam') ? true : false; // Explicitly set to true/false
            $module->mark = $request->input('mark');

            $module->save();

            return response()->json(['status' => 1, 'msg' => 'New Module Created']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function edit($id) {
        $data = Module::findOrFail($id);
        $course = Course::where('status', 'active')->get();
        return view('backend.layouts.module.edit', compact('data', 'course'));
    }

    public function update(Request $request, $id) {

        $rules = [
            'course_name' => 'required|numeric|exists:courses,id',
            'title' => 'required|string',
            'description' => $request->input('is_exam') ? 'nullable|string' : 'required|string',
            'question' => $request->input('is_exam') ? 'required|string' : 'nullable|string',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        try {
            $module = Module::findOrFail($id);

            $module->course_id = $request->course_name;

            // Assign values based on request
            $module->title = $request->title ?? null;  // Use null coalescing for clarity

            if ($request->is_exam) {
                $module->question = $request->input('question') ?? null;
                $module->content = null;
            } else {
                $module->content = $request->input('description') ?? null;
                $module->question = null;
            }

            $module->is_exam = $request->input('is_exam') ? true : false; // Explicitly set to true/false
            $module->mark = $request->input('mark');

            $module->save();

            return response()->json(['status' => 1, 'msg' => 'New Module Updated']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function status(int $id): JsonResponse {
        $data = Module::findOrFail($id);
        if ($data->status == 'inactive') {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        }
    }

    public function destroy(int $id): JsonResponse {
        $data = Module::findOrFail($id)->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
