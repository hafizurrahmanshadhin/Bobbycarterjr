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
            // Check if a user with the given email already exists
            $existingUser = User::withTrashed()->where('email', $request->input('email'))->first();

            if ($existingUser) {
                // If the user is found and is soft-deleted, restore the user
                if ($existingUser->trashed()) {
                    $existingUser->restore(); // Restore the soft-deleted user
                } else {
                    return Helper::jsonResponse(false, 'Email already registered.', 409);
                }
            } else {
                // If the user does not exist, create a new user record
                $existingUser = User::create([
                    'firstName'  => $request->input('firstName'),
                    'lastName'   => $request->input('lastName'),
                    'email'      => $request->input('email'),
                    'password'   => Hash::make($request->input('password')),
                    'free_until' => now()->addDays(7),
                ]);
            }

            // Generate a Sanctum token for the registered (or restored) user
            $token = $existingUser->createToken('auth_token')->plainTextToken;

            // Return a JSON response with user details and the generated token
            return response()->json([
                'status'     => true,
                'message'    => 'User registered successfully.',
                'code'       => 200,
                'token_type' => 'bearer',
                'token'      => $token,
                'data'       => new RegisterResource($existingUser),
            ]);
        } catch (Exception $e) {
            // Handle any errors that occur during the registration process
            return Helper::jsonResponse(false, 'An error occurred during registration.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
