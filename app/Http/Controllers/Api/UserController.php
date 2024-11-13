<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use URL;

class UserController extends Controller
{
     /**
     * Return Login User Data.
     *
     * @return JsonResponse
     */

    public function userData() : JsonResponse {
        $user = auth()->user();

        if (!$user) {
            return Helper::jsonResponse(true, 'User not authenticated', 200, []);
        }

        return Helper::jsonResponse(true, 'User data fetched successfully', 200, $user);
    }

    /**
     * Update User Infromation
     *
     * @param  \Illuminate\Http\Request  $request.
     * @return \Illuminate\Http\JsonResponse  JSON response with success or error.
     */

    public function userUpdate(Request $request, int $id) {

        $validator = Validator::make($request->all(), [
            'avatar' => 'nullable|image|mimes:jpeg,png,gif|max:5120',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($request->user() ? $request->user()->id : 'NULL'),
        ]);

        if ($validator->fails()){
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // If user is not found, return an error response
            if (!$user) {
                return Helper::jsonResponse(false, 'User not authenticated.', 401, []);
            }

            if ($request->hasFile('avatar')) {

                if ($user->avatar) {
                    $previousImagePath = public_path($user->avatar);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }

                $image                        = $request->file('avatar');
                $imageName                    = Helper::fileUpload($image, 'User/Avatar', $image->getClientOriginalName());
            } else {
                $imageName = $user->avatar;
            }

            $user->firstName = $request->first_name;
            $user->lastName = $request->last_name;
            $user->email = $request->email;
            $user->avatar = $imageName;

            $user->save();

            return Helper::jsonResponse(true, 'User Information Updated.', 200, $user);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred during updating data.', 500, $e->getMessage());
        }
    }


    /**
     * Password Reset to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function updatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {
            // Get the authenticated user
            $user = auth()->user();

            if (!$user) {
                return Helper::jsonResponse(false, 'User not authenticated', 401);
            }

            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return Helper::jsonResponse(false, 'Current password is incorrect', 422);
            }

            // Update the user's password
            $user->password = Hash::make($request->password); // Hash the new password
            $user->save(); // Save the changes

            // Return a success response
            return Helper::jsonResponse(true, 'Password changed successfully.', 200, $user);
        } catch (\Exception $e) {
            // Handle any exceptions and return an error response
            return Helper::jsonResponse(true, 'An error occurred during Deleting User.', 500, $e->getMessage());
        }
     }

    /**
     * Delete the authenticated user's account
     *
     * @return \Illuminate\Http\JsonResponse JSON response with success or error.
     */

    public function userDelete() {
        try {
            // Get the authenticated user
            $user = auth()->user();

            if (!$user) {
                return Helper::jsonResponse(false, 'User not authenticated.', 401, []);
            }

            // Delete the user's avatar if it exists
            if ($user->avatar) {
                $previousImagePath = public_path($user->avatar);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            // Delete the user
            $user->delete();

            return Helper::jsonResponse(true, 'User deleted successfully.', 200, []);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred during Deleting User.', 500, $e->getMessage());
        }
    }

    /**
     * Generate a unique link for the specified user profile.
     *
     * @param int $user_id
     * @return JsonResponse
     */
    public function generateLink(int $user_id): JsonResponse {
        try {
            // Fetch the user or fail
            $user = User::findOrFail($user_id);

            // Generate the URL for the user's profile
            $link = url('/user/' . $user->id);

            return Helper::jsonResponse(true, 'User profile link generated successfully', 200, ['link' => $link]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while generating the user profile link.', 500, ['error' => $e->getMessage()]);
        }
    }
}
