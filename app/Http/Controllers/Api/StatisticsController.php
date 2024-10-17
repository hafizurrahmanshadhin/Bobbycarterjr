<?php

namespace App\Http\Controllers\api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    /**
     * Store Completed module.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function completeModule(int $module_id) {

        $user = Auth::user();

        // Ensure the user is authenticated
        if (!$user) {
            return Helper::jsonResponse(false, 'User Not Authenticated', 401, []);
        }

        $isAttached = $user->completedModules()->where('module_id', $module_id)->exists();

        if (!$isAttached) {
            // Attach the article to the user as read
            $user->completedModules()->attach($module_id);
        }

        return Helper::jsonResponse(true, 'Course Module Complete successfully', 200, $isAttached);
    }

    /**
     * Return Total Modul Status.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function moduleStatus(int $course_id) {

        $module = Module::where('course_id', $course_id)->get();

        // $total =


        return Helper::jsonResponse(true, 'Course Module Status retrieved successfully', 200, $module);
    }
}
