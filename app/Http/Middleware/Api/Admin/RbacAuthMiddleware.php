<?php

namespace App\Http\Middleware\Api\Admin;

use App\Traits\Api\ApiResponse;
use Closure;

class RbacAuthMiddleware
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {

        if(!\Auth::user()->hasRule(\Route::currentRouteName()))
        {
            return $this->failed('你无权访问');
        }

        return $next($request);
    }
}
