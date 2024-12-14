<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // if (!Auth::check()) {
        //     return redirect('/login'); // If not logged in, redirect to login
        // }
    
        // if (Auth::user()->usertype != 'admin') {
        //     return redirect('/login'); // Non-admin users redirected to home
        // }

        return $next($request);
    }
}
