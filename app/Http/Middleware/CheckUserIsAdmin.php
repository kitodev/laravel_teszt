<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserIsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return $next($request);
            }
        }
        return redirect('/login')->with('error', 'You do not have permission to access this page.');
    }
}
