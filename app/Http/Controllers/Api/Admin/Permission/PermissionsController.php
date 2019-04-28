<?php

namespace App\Http\Controllers\Api\Admin\Permission;

use App\Http\Controllers\Api\Admin\AdminBaseController;
use App\Http\Requests\Api\Admin\Permission\CreatePermissionRequest;
use App\Services\Admin\PermissionsService;

class PermissionsController extends AdminBaseController
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
