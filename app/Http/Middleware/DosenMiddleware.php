<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk memastikan user yang mengakses adalah dosen.
 * Middleware ini akan:
 * 1. Cek apakah user sudah login
 * 2. Cek apakah role user adalah 'dosen'
 * 3. Redirect ke login jika belum login
 * 4. Return 403 jika bukan dosen
 */
class DosenMiddleware
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

        // Cek apakah user memiliki role 'dosen'
        if ($user->role->name !== 'dosen') {
            abort(403);
        }

        return $next($request);
    }
}
