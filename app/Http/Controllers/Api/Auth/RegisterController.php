<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    /**
     * Handle user registration.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */
    public function Register(RegisterRequest $request): JsonResponse {
        try {
            //* Create a new user record in the database
            $user = User::create([
                'firstName' => $request->input('firstName'),
                'lastName'  => $request->input('lastName'),
                'email'     => $request->input('email'),
                'password'  => Hash::make($request->input('password')),
            ]);

            //? Check if user creation was successful
            if (!$user) {
                return Helper::jsonResponse(false, 'User registration failed.', 500);
            }

            //* Generate a Sanctum token for the registered user
            $token = $user->createToken('auth_token')->plainTextToken;

            //! Return a JSON response with user details and the generated token
            return response()->json([
                'status'     => true,
                'message'    => 'User registered successfully.',
                'code'       => 200,
                'token_type' => 'bearer',
                'token'      => $token,
                'data'       => new RegisterResource($user),
            ]);
        } catch (Exception $e) {
            //! Handle any errors that occur during the registration process
            return Helper::jsonResponse(false, 'An error occurred during registration.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
