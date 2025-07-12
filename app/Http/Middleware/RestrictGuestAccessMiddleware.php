<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictGuestAccessMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $user = $request->user();

        // If user is a guest, check if they're accessing allowed routes
        if ($user && $user->role === 'guest') {
            $allowedRoutes = [
                'course/types',
                'courses',
                'recommend/course',
            ];

            $currentPath = $request->path();
            $currentPath = str_replace('api/', '', $currentPath); // Remove api prefix if exists

            $isAllowed = false;
            foreach ($allowedRoutes as $allowedRoute) {
                if (str_contains($currentPath, $allowedRoute)) {
                    $isAllowed = true;
                    break;
                }
            }

            if (!$isAllowed) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Access denied. Guest users have limited access. Please upgrade your account.',
                    'code'    => 403,
                ], 403);
            }
        }

        return $next($request);
    }
}
