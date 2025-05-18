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
        Artisan::call('optimize:clear');

        return Helper::jsonResponse(true, 'Migrations have been Refreshed, Seeded, and Cache Cleared!', 200);
    }

    /**
     * Run Migrate
     *
     * @return JsonResponse
     */
    public function RunMigrate(): JsonResponse {
        Artisan::call('migrate');

        return Helper::jsonResponse(true, 'Migrate Done.', 200);
    }
}
