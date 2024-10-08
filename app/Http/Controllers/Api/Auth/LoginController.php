<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
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
            $request->authenticate();

            //* Get the authenticated user
            $user = Auth::user();

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
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred during login.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
