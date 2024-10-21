<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use FFMpeg;

class CourseModuleController extends Controller {

    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = Module::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('course_name', function ($data) {
                    return $data->course->name;
                })
                ->addColumn('audio_time', function ($data) {
                    $page_content = $data->audio_time; // Assume this is in seconds

                    if ($page_content === null) {
                        // If audio_time is null, don't show any time
                        return null; // Or you can return an empty string or message
                    }

                    if ($page_content < 60) {
                        // Less than one minute, show seconds
                        $formatted_time = floor($page_content) . ' second' . ($page_content > 1 ? 's' : '');
                    } else {
                        // More than one minute, calculate minutes
                        $minutes = floor($page_content / 60);

                        // Format output: only show minutes and omit seconds
                        $formatted_time = $minutes . ' minute' . ($minutes > 1 ? 's' : '');
                    }

                    // Optionally return the formatted time if needed
                    return $formatted_time;
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

                                <a href="#" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="viewModule(' . $data->id . ')">
                                    <i class="fe fe-eye"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['course_name', 'audio_time', 'status', 'module', 'action'])
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
            'mark'        => 'required|numeric',
            'title'       => 'required|string',
            'description' => $request->input('is_exam') ? 'nullable|string' : 'required|string',
            'question'    => $request->input('is_exam') ? 'required|string' : 'nullable|string',
            'file' => $request->input('is_exam') ? 'nullable|file|max:20480' : 'required|file|max:20480',
            'audio_duration' => $request->input('is_exam') ? 'nullable|numeric' : 'required|numeric',
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
            $module->title = $request->title ?? null; // Use null coalescing for clarity

            if ($request->is_exam) {
                $module->question = $request->input('question') ?? null;
            } else {
                $module->content = $request->input('description') ?? null;
            }

            if (!$request->is_exam) {

                // Handle image upload
                if ($request->hasFile('file')) {
                    $file                        = $request->file('file');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $filePath = Helper::fileUpload($file, 'Module', $fileName);

                    //store Database
                    $module->file_url = $filePath;
                    $module->audio_time = $request->audio_duration;
                }
            }

            $module->is_exam = $request->input('is_exam') ? true : false; // Explicitly set to true/false
            $module->mark    = $request->input('mark');

            $module->save();

            return response()->json(['status' => 1, 'msg' => 'New Module Created']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function edit($id) {
        $data   = Module::findOrFail($id);
        $course = Course::where('status', 'active')->get();
        return view('backend.layouts.module.edit', compact('data', 'course'));
    }

    public function update(Request $request, $id) {

        $rules = [
            'course_name' => 'required|numeric|exists:courses,id',
            'title'       => 'required|string',
            'description' => $request->input('is_exam') ? 'nullable|string' : 'required|string',
            'question'    => $request->input('is_exam') ? 'required|string' : 'nullable|string',
            'file' => $request->input('is_exam') ? 'nullable|file|max:20480' : 'nullable|file|max:20480',
            'audio_duration' => $request->input('is_exam') ? 'nullable|numeric' : 'nullable|numeric',
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
            $module->title = $request->title ?? null; // Use null coalescing for clarity

            if ($request->is_exam) {
                $module->question = $request->input('question') ?? null;
                $module->content  = null;
            } else {
                $module->content  = $request->input('description') ?? null;
                $module->question = null;
            }

            if (!$request->is_exam) {

                // Handle image upload
                if ($request->hasFile('file')) {

                    if ($module->file_url) {
                        $previousImagePath = public_path($module->file_url);
                        if (file_exists($previousImagePath)) {
                            unlink($previousImagePath);
                        }
                    }

                    $file                        = $request->file('file');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $filePath = Helper::fileUpload($file, 'Module', $fileName);

                    //store Database
                    $module->file_url = $filePath;
                    $module->audio_time = $request->audio_duration;
                }
            }

            $module->is_exam = $request->input('is_exam') ? true : false; // Explicitly set to true/false
            $module->mark    = $request->input('mark');

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

    /**
     * Display the specified Course Module.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function single(int $id): JsonResponse {
        try {
            $data = Module::with('course')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
