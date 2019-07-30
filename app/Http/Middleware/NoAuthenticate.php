<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Sentinel;

class NoAuthenticate
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
        if (Sentinel::check())
            return redirect()->route('admin.dashboard');

        return $next($request);
    }
}
