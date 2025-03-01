<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
       
        if (Auth::check() && Auth::user()->email === 'adad@gmail.com') {
            return $next($request);
        }

       
        return redirect()->route('home')->with('error', 'У вас нет прав');
    }
}