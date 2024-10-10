<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
