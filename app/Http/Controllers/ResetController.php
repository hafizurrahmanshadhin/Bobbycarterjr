<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;

class ResetController extends Controller {
    /**
     * Reset Database and Optimize Clear
     *
     * @return JsonResponse
     */
    public function RunMigrations(): JsonResponse {
        // Artisan::call('migrate:fresh --seed');
        Artisan::call('optimize:clear');

        return Helper::jsonResponse(true, 'Migrations have been Refreshed, Seeded, and Cache Cleared!', 200);
    }
}
