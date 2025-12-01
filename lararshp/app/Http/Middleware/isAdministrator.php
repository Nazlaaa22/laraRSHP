<?php

namespace App\Http\Middleware;

use Closure;

class isAdministrator
{
    public function handle($request, Closure $next)
    {
        if (strtolower(session('role') ?? '') !== 'administrator') {
            return redirect('/login')->withErrors(['loginError' => 'Akses ditolak, bukan admin']);
        }

        return $next($request);
    }

}
