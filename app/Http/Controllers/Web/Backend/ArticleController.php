<?php

namespace App\Http\Controllers\web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;

class ArticleController extends Controller
{
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = Article::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('course_name', function ($data) {
                    return $data->course->name ?? '';
                })
                ->addColumn('description', function ($data) {
                    $page_content       = $data->description;
                    $short_page_content = strlen($page_content) > 100 ? substr($page_content, 0, 100) . '...' : $page_content;
                    return '<p>' . $short_page_content . ' </p>';
                })
                ->addColumn('image_url', function ($data) {
                    $url = asset($data->image_url);
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
                                <a href="' . route('admin.article.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['course_name', 'description', 'image_url','status', 'action'])
                ->make();
        }
        return view('backend.layouts.article.index');
    }

    public function create() {
        $course = Course::where('status', 'active')->get();
        return view('backend.layouts.article.create', compact('course'));
    }

    public function store(Request $request) {

        // Validate the request
        $validator = $request->validate([
            'course_name' => 'required|numeric|exists:courses,id',
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string'
        ]);

        try {

            // Handle image upload
            if ($request->hasFile('image')) {
                $image                        = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($image, 'Article', $imageName);
            }

            Article::create([
                'course_id' => $request->course_name,
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imagePath
            ]);

            return to_route('admin.article.index')->with('t-success', 'New Article Created');
        } catch (\Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function edit($id) {
        $data = Article::findOrFail($id);
        $course = Course::where('status', 'active')->get();
        return view('backend.layouts.article.edit', compact('data', 'course'));
    }

    public function update(Request $request, $id) {

        $validator = $request->validate([
            'course_name' => 'required|numeric|exists:courses,id',
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string'
        ]);

        try {

            $data = Article::findOrFail($id);
            // Handle image upload
            if ($request->hasFile('image')) {

                if ($data->image_url) {
                    $previousImagePath = public_path($data->image_url);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }

                $image                        = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($image, 'Article', $imageName);
            }

            $data->update([
                'course_id' => $request->course_name,
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imagePath
            ]);

            return to_route('admin.article.index')->with('t-success', 'New Article Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function status(int $id): JsonResponse {
        $data = Article::findOrFail($id);
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
        $data = Article::findOrFail($id);

        if ($data->image_url) {
            $previousImagePath = public_path($data->image_url);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }

        $data->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
