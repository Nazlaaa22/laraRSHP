<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isResepsionis
{
    public function handle($request, Closure $next)
    {
        if (session('role') !== 'resepsionis' && session('role') !== 'Resepsionis') {
            return redirect('/login')->withErrors(['loginError' => 'Akses ditolak!']);
        }

        return $next($request);
    }
}

