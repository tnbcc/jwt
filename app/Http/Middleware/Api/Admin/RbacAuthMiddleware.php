<?php

namespace App\Http\Middleware\Api\Admin;

use App\Repositories\Admin\Log\LogsRepository;
use App\Traits\Api\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class RbacAuthMiddleware
{
    use ApiResponse;

    protected $logsRepository;

    public function __construct(LogsRepository $logsRepository)
    {
        $this->logsRepository = $logsRepository;
    }

    public function handle(Request $request, Closure $next)
    {

        /**记录用户操作日志**/
        if(in_array($request->method(),['POST','PUT','PATCH','DELETE']))
        {
            $this->logsRepository->mudelActionLogCreate($request);
        }

        if(!\Auth::user()->hasRule(\Route::currentRouteName()))
        {
            return $this->failed(trans('api.auth.no_permission'), 403);
        }

        return $next($request);
    }
}
