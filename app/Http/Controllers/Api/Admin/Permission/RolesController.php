<?php

namespace App\Http\Controllers\Api\Admin\Permission;

use App\Handlers\Tree;
use App\Http\Controllers\Api\Admin\AdminBaseController;
use App\Http\Requests\Api\Admin\Permission\CreateRoleRequest;
use App\Http\Requests\Api\Admin\Permission\StoreRolePermissionRequest;
use App\Models\Admin\Permission\AdminRole;
use App\Repositories\Admin\Permission\PermissionsRepository;
use App\Repositories\Admin\Permission\RolesRepository;
use Illuminate\Http\Request;

class RolesController extends AdminBaseController
{
    public function __construct(RolesRepository $repository)
    {
        $this->repository = $repository;
    }

    //角色列表
    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    //创建角色
    public function store(CreateRoleRequest $request)
    {
        return $this->repository->store($request);
    }

    //展示分配权限页面
    public function permission(AdminRole $role, PermissionsRepository $permissionsRepository, Tree $tree)
    {
        return $this->repository->permission($role, $permissionsRepository, $tree);
    }

    //创建某个角色权限
    public function storePermission(StoreRolePermissionRequest $request, AdminRole $role)
    {
      return $this->repository->storePermission($request, $role);
    }
}
