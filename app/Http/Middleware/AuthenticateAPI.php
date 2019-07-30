<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateAPI
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
        $user = Auth::guard('api')->user();
        if (!$user)
            return response()->json($this->errorHandle('Please relogin to access'));

        return $next($request);
    }

    private function errorHandle($message = '')
    {
        return ['status' => 'error', 'code' => 401, 'message' => $message];
    }
}
