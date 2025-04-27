<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsGuru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->guard('gurus')->user();

        // Pastikan user terautentikasi dan memiliki properti 'kepalasekolah' atau kondisi lainnya
        if ($user && $user->kepalasekolah == 'ya' && $user->email_verified_at) {
            return $next($request);
        }

        // Jika bukan 'gurus', abort dengan status 403
        return redirect('/not-authorized');
    }
}
