<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk memastikan user yang mengakses adalah admin.
 * Middleware ini akan:
 * 1. Cek apakah user sudah login
 * 2. Cek apakah role user adalah 'admin'
 * 3. Redirect ke login jika belum login
 * 4. Return 403 jika bukan admin
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Cek apakah user memiliki role 'admin'
        if ($user->role->name !== 'admin') {
            abort(403);
        }

        return $next($request);
    }
}
