<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\DailyAffirmation;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class DailyAffirmationController extends Controller
{
    /**
     * Index Page Daily Affirmation.
     *
     * @param int $id
     * @return JsonResponse
    */

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
}
