<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Jika pengguna tidak terautentikasi, arahkan ke halaman abort 403.
     */
    protected function unauthenticated($request, array $guards)
    {
        abort(Response::HTTP_FORBIDDEN, 'Unauthorized access.');
    }
}
