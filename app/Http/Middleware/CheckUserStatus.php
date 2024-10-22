<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helper;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user's status is 'active'
            if ($user->status === 'active') {
                return $next($request); // Proceed to the next middleware/request
            }
        }

        // If not authenticated or not active, return a response
        return Helper::jsonResponse(false, 'User is deactivated', 403, []);
    }
}
