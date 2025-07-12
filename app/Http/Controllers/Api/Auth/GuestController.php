<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\RegisterResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuestController extends Controller {
    /**
     * Handle guest user creation.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function createGuest(Request $request): JsonResponse {
        try {
            // Generate unique guest email
            $guestEmail = $this->generateUniqueGuestEmail();

            // Generate random password
            $guestPassword = Str::random(12);

            // Create guest user
            $guestUser = User::create([
                'firstName'  => 'Guest',
                'lastName'   => 'User',
                'email'      => $guestEmail,
                'password'   => Hash::make($guestPassword),
                'role'       => 'guest',
                'free_until' => now()->addDays(7),
            ]);

            // Generate a Sanctum token for the guest user
            $token = $guestUser->createToken('guest_auth_token')->plainTextToken;

            // Return a JSON response with user details and token
            return response()->json([
                'status'            => true,
                'message'           => 'Guest user created successfully.',
                'code'              => 200,
                'token_type'        => 'bearer',
                'token'             => $token,
                'data'              => new RegisterResource($guestUser),
                'guest_credentials' => [
                    'email'    => $guestEmail,
                    'password' => $guestPassword,
                ],
            ]);
        } catch (Exception $e) {
            // Handle any errors that occur during guest creation
            return Helper::jsonResponse(false, 'An error occurred during guest creation.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Generate a unique guest email
     *
     * @return string
     */
    private function generateUniqueGuestEmail(): string {
        do {
            $uniqueId = Str::random(8) . time();
            $email    = "guest_{$uniqueId}@guest.com";
        } while (User::where('email', $email)->exists());

        return $email;
    }
}
