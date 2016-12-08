<?php

namespace App\Http\Middleware\Authorizer;

use Closure;
use Illuminate\Support\Facades\Auth;

class WebAuthorizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $customRequest)
    {
        return $next($request);
    }
}
