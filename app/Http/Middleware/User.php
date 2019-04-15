<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(!Auth::check()){
            return redirect('/login');
        }
        if (auth()->user()->role_id != 2) {
            return redirect('/unauthorize')->with('error', 'Your don\'t have permission to access.');
        }
        return $next($request);
    }
}
