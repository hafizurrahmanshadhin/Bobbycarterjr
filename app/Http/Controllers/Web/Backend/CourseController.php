<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CourseController extends Controller {
    /**
     * Display the list of all courses.
     *
     * @param Request $request
     * @return JsonResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = Course::with('courseType')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('courseType', function ($data) {
                    return $data->courseType->name ?? 'N/A';
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
                ->addColumn('image', function ($data) {
                    $url = asset($data->image_url);
                    return "<img src='$url' width='100'>";
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editCourse(' . $data->id . ')">
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['courseType', 'status', 'image', 'action'])
                ->make(true);
        }
        return view('backend.layouts.course.index');
    }

    /**
     * Store a newly created course in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        try {
            $validated = $request->validate([
                'course_type_id' => 'required|exists:course_types,id',
                'name'           => 'required|string|max:255',
                'image'          => 'required|image|mimes:jpeg,png,jpg|max:10240',
            ]);

            $course                 = new Course();
            $course->course_type_id = $validated['course_type_id'];
            $course->name           = $validated['name'];

            if ($request->hasFile('image')) {
                $image             = $request->file('image');
                $imageName         = time() . '.' . $image->getClientOriginalExtension();
                $imagePath         = Helper::fileUpload($image, 'Course', $imageName);
                $course->image_url = $imagePath;
            }

            $course->save();

            // Prepare the notification data for the new course.
            $notificationData = [
                'title' => 'New Course Available!',
                'body'  => 'A new course "' . $course->name . '" has been created. Check it out now!',
            ];

            // Retrieve all users that are subscribed.
            $users = User::where('role', 'user')->get();

            // Loop through each user and send the push notification.
            foreach ($users as $user) {
                $this->sendPushNotification($user->id, $notificationData);
            }

            return response()->json(['success' => true, 'message' => 'Course created successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    protected function sendPushNotification($userId, $notificationData) {
        try {
            Log::info("Attempting to send push notification to user ID: $userId for new course");

            $factory   = (new \Kreait\Firebase\Factory)->withServiceAccount(storage_path('app/firebase_push_Nofifications.json'));
            $messaging = $factory->createMessaging();

            // Retrieve Firebase tokens for the user.
            $tokens = \App\Models\FirebaseToken::where('user_id', $userId)->pluck('token')->toArray();

            if (empty($tokens)) {
                Log::info("No active Firebase tokens found for user ID: $userId");
                return;
            }

            Log::info("Firebase tokens for user ID: $userId", ['tokens' => $tokens]);

            $notification = \Kreait\Firebase\Messaging\Notification::create($notificationData['title'], $notificationData['body']);
            $message      = \Kreait\Firebase\Messaging\CloudMessage::new ()->withNotification($notification);

            Log::info("Notification payload for user ID: $userId", [
                'title' => $notificationData['title'],
                'body'  => $notificationData['body'],
            ]);

            $messaging->sendMulticast($message, $tokens);

            Log::info("Push notification sent successfully to user ID: $userId");
        } catch (Exception $e) {
            Log::error("Failed to send push notification to user ID: $userId. Error: {$e->getMessage()}");
        }
    }

    /**
     * Get all course types.
     *
     * @return JsonResponse
     */
    public function getCourseTypes(): JsonResponse {
        try {
            $courseTypes = CourseType::where('status', 'active')->whereNull('deleted_at')->get();
            return response()->json(['success' => true, 'data' => $courseTypes]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the specified course for editing.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse {
        try {
            $course = Course::with('courseType')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $course]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified course in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse {
        try {
            $validated = $request->validate([
                'course_type_id' => 'required|exists:course_types,id',
                'name'           => 'required|string|max:255',
                'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            $course                 = Course::findOrFail($id);
            $course->course_type_id = $validated['course_type_id'];
            $course->name           = $validated['name'];

            if ($request->hasFile('image')) {
                if ($course->image_url) {
                    $previousImagePath = public_path($course->image_url);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
                $image             = $request->file('image');
                $imageName         = time() . '.' . $image->getClientOriginalExtension();
                $imagePath         = Helper::fileUpload($image, 'Course', $imageName);
                $course->image_url = $imagePath;
            }

            $course->save(); // Save the updated course

            return response()->json(['success' => true, 'message' => 'Course updated successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified course from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $course = Course::find($id);

            if ($course) {
                if ($course->image_url && file_exists(public_path($course->image_url))) {
                    unlink(public_path($course->image_url));
                }

                $course->delete();

                return response()->json(['success' => true, 'message' => 'Course and associated image deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Course not found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Change the status of the specified course.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        try {
            $course = Course::findOrFail($id);

            $course->status = $course->status == 'active' ? 'inactive' : 'active';
            $course->save();

            return response()->json([
                'success' => true,
                'message' => $course->status == 'active' ? 'Published Successfully.' : 'Unpublished Successfully.',
                'data'    => $course,
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
