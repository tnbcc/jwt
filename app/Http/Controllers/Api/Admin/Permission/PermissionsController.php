<?php

namespace App\Http\Controllers\Api\Admin\Permission;

use App\Http\Requests\Api\Admin\Permission\CreatePermissionRequest;
use App\Repositories\Admin\Permission\PermissionsRepository;
use App\Services\Admin\PermissionsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    protected $permissionsService;

    public function __construct(PermissionsService $permissionsService)
    {
        $this->permissionsService = $permissionsService;
    }

    //权限列表
    public function index()
    {
        return $this->permissionsService->getRulesTree();
    }

    //创建权限
    public function store(CreatePermissionRequest $request)
    {
        return $this->permissionsService->store($request);
    }
}
