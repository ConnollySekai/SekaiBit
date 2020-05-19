<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Registered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (User::count() > 0) {
            return redirect(route('home'));
        }
        
        return $next($request);
    }
}
