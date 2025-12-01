<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isResepsionis
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'resepsionis') {
            return redirect('/login')->withErrors(['loginError' => 'Akses ditolak!']);
        }

        return $next($request);
    }
}
