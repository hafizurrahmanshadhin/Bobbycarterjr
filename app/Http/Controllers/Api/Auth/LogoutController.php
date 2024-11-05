<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\UserStatusUpdated;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller {
    /**
     * Handle user logout.
     *
     * @return JsonResponse
     */
    public function Logout(): JsonResponse {
        try {
            $user = Auth::user();

            //! Revoke the token that was used to authenticate the current request
            $user->currentAccessToken()->delete();

            //* Update is_online status to false
            $user->is_online = false;
            $user->save();

            //* Dispatch the UserStatusUpdated event
            event(new UserStatusUpdated($user));

            return Helper::jsonResponse(true, 'User logged out successfully.', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred during logout.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
