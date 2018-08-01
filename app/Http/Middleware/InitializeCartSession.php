<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Illuminate\Http\Request;

class InitializeCartSession
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if ($request->session()->has("cart") == null) {
            $request->session()->put("cart", []);
        }
        return $next($request);
    }
}
