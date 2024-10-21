<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CourseTypeController extends Controller {
    /**
     * Display the list of all course types.
     *
     * @param Request $request
     * @return JsonResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = CourseType::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $url = asset($data->image);
                    return "<img src='$url' width='100'>";
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
                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editCourseType(' . $data->id . ')">
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.course-type.index');
    }

    /**
     * Store a newly created course type in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $imagePath = Helper::fileUpload($request->file('image'), 'course_types', $validated['name']);

        $courseType        = new CourseType();
        $courseType->name  = $validated['name'];
        $courseType->image = $imagePath;
        $courseType->save();

        return Helper::jsonResponse(true, 'Course type created successfully', 201);
    }

    /**
     * Show the modal for editing the specified course type.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse {
        $courseType = CourseType::find($id);
        if ($courseType) {
            return response()->json(['success' => true, 'data' => $courseType]);
        } else {
            return response()->json(['success' => false, 'message' => 'Course type not found']);
        }
    }

    /**
     * Update the specified course type in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $courseType = CourseType::find($id);

        if (!$courseType) {
            return Helper::jsonResponse(false, 'Course type not found', 404);
        }

        $courseType->name = $validated['name'];

        if ($request->hasFile('image')) {
            Helper::fileDelete(public_path($courseType->image));
            $courseType->image = Helper::fileUpload($request->file('image'), 'course_types', $validated['name']);
        }

        $courseType->save();

        return Helper::jsonResponse(true, 'Course type updated successfully', 200);
    }

    /**
     * Remove the specified course type from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $courseType = CourseType::find($id);
        if ($courseType) {
            if ($courseType->image && file_exists(public_path($courseType->image))) {
                unlink(public_path($courseType->image));
            }

            $courseType->delete();

            return response()->json(['success' => true, 'message' => 'Course type and associated image deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Course type not found']);
        }
    }

    /**
     * Change the status of the specified course type.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = CourseType::findOrFail($id);

        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();
            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        }
    }
}
