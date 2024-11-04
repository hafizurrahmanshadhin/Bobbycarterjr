<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\UserStatusUpdated;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    /**
     * Handle user login.
     *
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function Login(LoginRequest $request): JsonResponse {
        try {
            //! Attempt to authenticate the user

            $user = User::where('email', $request->email)->first();

            if ($user === null) {
                return Helper::jsonResponse(false, 'User Not Found', 404, []);
            }

            if ($user->status == 'active') {
                $request->authenticate();

                //* Get the authenticated user
                $user = Auth::user();

                //* Update is_online status to true
                $user->is_online = true;
                $user->save();

                //* Dispatch the UserStatusUpdated event
                event(new UserStatusUpdated($user));

                //* Generate token
                $token = $user->createToken('auth_token')->plainTextToken;

                //! Return response using UserResource
                return response()->json([
                    'status'     => true,
                    'message'    => 'User logged in successfully.',
                    'code'       => 200,
                    'token_type' => 'bearer',
                    'token'      => $token,
                    'data'       => new LoginResource($user),
                ]);
            } else {
                return Helper::jsonResponse(false, 'User is deactivated', 403, []);
            }

        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred during login.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
