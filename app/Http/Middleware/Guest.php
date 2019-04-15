<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Guest {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            switch (auth()->user()->role_id) {
                case 1:
                    return redirect()->route('admin');
                    break;
                case 2:
                    return redirect()->route('/');
                    break;
                default :
                    return redirect('/');
                    break;
            }
        }
        return $next($request);
    }

}
