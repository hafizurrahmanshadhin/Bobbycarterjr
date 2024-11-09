<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller {
    /**
     * Return Article Under a Course Data.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = Article::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('course_name', function ($data) {
                    return $data->course->name ?? '';
                })
                ->addColumn('title', function ($data) {
                    $page_content       = $data->title;
                    $short_page_content = strlen($page_content) > 70 ? substr($page_content, 0, 70) . '...' : $page_content;
                    return '<p>' . $short_page_content . ' </p>';
                })
                ->addColumn('image_url', function ($data) {
                    $url = asset($data->image_url);
                    return "<img src='$url' width='100'>";
                })
                ->addColumn('file_url', function ($data) {
                    $url = asset($data->file_url);

                    if($data->file_url){
                        $tag = "<audio src='$url' controls=''></audio>";
                    } else {
                        $tag = '';
                    }

                    return $tag;
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
                ->rawColumns(['course_name', 'title', 'image_url', 'file_url', 'audio_time', 'status', 'action'])
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
            'title'       => 'required|string',
            'mark'        => 'required|numeric',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:4000',
            'description' => 'required|string',
            'file' => 'nullable|file|max:20480',
            'audio_duration' => 'nullable|numeric',
        ]);

        try {

            // Handle image upload
            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($image, 'Article', $imageName);
            }

            // Handle image upload
            if ($request->hasFile('file')) {
                $file                        = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = Helper::fileUpload($file, 'Article/audio', $fileName);
            }

            Article::create([
                'course_id'   => $request->course_name,
                'title'       => $request->title,
                'description' => $request->description,
                'mark'        => $request->mark,
                'image_url'   => $imagePath,
                'file_url'   => $filePath ?? null,
                'audio_time'   => $request->audio_duration,
            ]);

            return to_route('admin.article.index')->with('t-success', 'New Article Created');
        } catch (\Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function edit($id) {
        $data   = Article::findOrFail($id);
        $course = Course::where('status', 'active')->get();
        return view('backend.layouts.article.edit', compact('data', 'course'));
    }

    public function update(Request $request, $id) {

        $validator = $request->validate([
            'course_name' => 'required|numeric|exists:courses,id',
            'title'       => 'required|string',
            'mark'        => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:4000',
            'description' => 'required|string',
            'file' => 'nullable|file|max:20480',
            'audio_duration' => 'nullable|numeric',
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

                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($image, 'Article', $imageName);
            } else {
                $imagePath = $data->image_url;
            }

            // Handle image upload
            if ($request->hasFile('file')) {

                if ($data->file_url) {
                    $previousImagePath = public_path($data->file_url);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }


                $file                        = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = Helper::fileUpload($file, 'Article/audio', $fileName);
            } else {
                $filePath = $data->file_url;
            }

            $data->update([
                'course_id'   => $request->course_name,
                'title'       => $request->title,
                'mark'        => $request->mark,
                'description' => $request->description,
                'image_url'   => $imagePath,
                'file_url'   => $filePath,
                'audio_time'   => $request->audio_duration ?? $data->audio_time,
            ]);

            return to_route('admin.article.index')->with('t-success', 'Article Updated');
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

        if ($data->file_url) {
            $previousImagePath = public_path($data->file_url);
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
