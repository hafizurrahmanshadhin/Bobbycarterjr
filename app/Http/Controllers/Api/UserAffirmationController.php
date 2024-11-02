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
                'notification_time' => 'required|date_format:H:i',
            ]);

            $user            = Auth::user();
            $userAffirmation = UserAffirmation::where('user_id', $user->id)->first();

            $data = [
                'notification_time' => $validatedData['notification_time'],
            ];

            //? If user affirmation exists, update it, otherwise create a new record
            if ($userAffirmation) {
                $userAffirmation->update($data);
                return Helper::jsonResponse(true, 'Affirmation updated successfully!', 200, $userAffirmation);
            } else {
                $userAffirmation = UserAffirmation::create(array_merge(['user_id' => $user->id], $data));
                return Helper::jsonResponse(true, 'Affirmation created successfully!', 200, $userAffirmation);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
