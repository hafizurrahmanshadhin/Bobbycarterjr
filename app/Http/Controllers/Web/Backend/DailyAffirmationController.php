<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\DailyAffirmation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DailyAffirmationController extends Controller
{

    public function index() {
        $data = DailyAffirmation::get();
        return view('backend.layouts.dailyAffirmation.index', compact('data'));
    }

     /**
     * Display the Single Affirmation.
     *
     * @param int $id
     * @return JsonResponse
    */

    public function single(int $id): JsonResponse {
        try {
            $data = DailyAffirmation::findOrFail($id);
            return response()->json(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update Affirmation.
     *
     * @param int $id
     * @return JsonResponse
    */

    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'notification' => 'required|string',
            'id' => 'required|numeric|exists:daily_affirmations,id',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $done = DailyAffirmation::where('id', $request->id)->update([
                'notification' => $request->notification,
                'updated_at' => Carbon::now(),
            ]);

            if ($done) {
                return response()->json(['status' => 1, 'msg' => 'Update Successful']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Update failed']);
            }
        }
    }
}
