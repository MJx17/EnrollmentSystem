<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckWildcardPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission)
    {
        $routeName = Route::currentRouteName();

        // dd($routeName);
        $user = Auth::user();

        if (!$user || !$user->hasWildcardPermission($routeName)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
