<?php

namespace App\Http\Middleware\Api\Admin;

use Closure;

class AdminGuardMiddleware
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
        config(['auth.defaults.guard'=>'admin']);
        return $next($request);
    }
}
