<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     */

    public function handle($request, Closure $next)
    {
        if( ! auth()->user()->isAdmin() ){
            Auth::logout();
            return redirect('/login')->with('status','Please Login as a Admin');
        }
        return $next($request);
    }
}
