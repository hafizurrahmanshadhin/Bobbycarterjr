<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class SubscriptionController extends Controller
{

    /**
     * Return Free Package Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function freePackage() {

        $data = Subscription::with('details')->where('type', 'free')->first();

        // Check if the ad was found
        if ($data === null) {
            return Helper::jsonResponse(true, 'Ad not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Package retrieved successfully', 200, $data);
    }

    /**
     * Return Premium Package Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function premiumPackage() {

        $data = Subscription::with('details')->where('type', 'premium')->first();

        // Check if the ad was found
        if ($data === null) {
            return Helper::jsonResponse(true, 'Ad not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Package retrieved successfully', 200, $data);
    }
}
