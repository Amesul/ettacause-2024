<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Authorization') === config('api.api_token')) {
            return $next($request);
        }
        if (!$request->header('Authorization')) {
            return response()->json(['error' => 'Token missing.'], 403);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
