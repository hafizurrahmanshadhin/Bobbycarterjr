<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller {
    /**
     * Display the list of all course types.
     *
     * @param Request $request
     * @return JsonResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = User::where('role', 'user')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $first_name = $data->firstName;
                    $last_name  = $data->lastName;
                    $full_name  = $first_name . ' ' . $last_name;

                    return $full_name;
                })
                ->addColumn('image', function ($data) {
                    $url = asset($data->avatar ?? 'backend/profile.jpeg');
                    return "<img src='$url' width='100' style='border-radius: 50%'>";
                })
                ->addColumn('is_subscribed', function ($data) {
                    $is_subscribed = $data->is_subscribed;
                    if ($data->is_subscribed == 1) {
                        $tag = "<span class='badge bg-success'>Premium</span>";
                    } else {
                        $tag = "<span class='badge bg-danger'>Free</span>";
                    }

                    return $tag;
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
                ->rawColumns(['name', 'is_subscribed', 'image', 'status'])
                ->make();
        }
        return view('backend.layouts.users.index');
    }

    /**
     * Change the status of the specified User.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        try {
            $data = User::findOrFail($id);

            $data->status = $data->status == 'active' ? 'inactive' : 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => $data->status == 'active' ? 'Published Successfully.' : 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
