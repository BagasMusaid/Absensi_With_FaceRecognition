<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Jika tidak memiliki izin, redirect ke halaman custom
        if (Gate::denies($permission)) {
            return redirect()->route('abort.403'); // Redirect ke halaman custom 403
        }

        return $next($request);
    }
}
