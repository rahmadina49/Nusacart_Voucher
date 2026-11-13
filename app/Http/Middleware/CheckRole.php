<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login (Guest), lempar ke halaman login
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        // Jika role user ada di dalam daftar yang diizinkan, lanjutkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, abort atau redirect
        abort(403, 'Unauthorized action.');
    }
}