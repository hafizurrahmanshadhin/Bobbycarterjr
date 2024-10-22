<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\UserAffirmation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAffirmationController extends Controller {
    /**
     * Store or update user affirmation.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeOrUpdateAffirmation(Request $request): JsonResponse {
        try {
            $validatedData = $request->validate([
                'notifications_count' => 'required|in:1,2,3',
            ]);

            $user            = Auth::user();
            $userAffirmation = UserAffirmation::where('user_id', $user->id)->first();

            if ($userAffirmation) {
                $userAffirmation->update([
                    'notifications_count' => $validatedData['notifications_count'],
                ]);
                return Helper::jsonResponse(true, 'Affirmation updated successfully!', 200, $userAffirmation);
            } else {
                $userAffirmation = UserAffirmation::create([
                    'user_id'             => $user->id,
                    'notifications_count' => $validatedData['notifications_count'],
                ]);
                return Helper::jsonResponse(true, 'Affirmation created successfully!', 200, $userAffirmation);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
