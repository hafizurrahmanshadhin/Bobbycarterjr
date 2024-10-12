<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     /**
     * Return Login User Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function userData() {
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
            'address' => 'nullable|string',
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
            $user->address = $request->address;
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
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ], [
            'password.min' => 'The password must be at least 8 characters long.',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {
            // Retrieve the user by email
            $user = User::where('email', $request->input('email'))->first();

            $user->password = Hash::make($request->input('password'));
            $user->save();

            return Helper::jsonResponse(true, 'Password Reset successfully.', 200, $user);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred during updating data.', 500, $e->getMessage());
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
}
