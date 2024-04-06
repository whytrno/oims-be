<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = Auth::user()->role_id;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        return response([
            'success' => false,
            'message' => "You don't have permission to access",
            'data' => null,
        ], 403);
    }
}
