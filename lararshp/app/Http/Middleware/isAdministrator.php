<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdministrator
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = session('user_role');
        if ($userRole != 1) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}
