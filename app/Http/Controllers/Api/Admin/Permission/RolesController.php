<?php

namespace App\Http\Controllers\Api\Admin\Permission;

use App\Http\Requests\Api\Admin\Permission\CreateRoleRequest;
use App\Http\Requests\Api\Admin\Permission\StoreRolePermissionRequest;
use App\Models\Admin\Permission\AdminRole;
use App\Repositories\Admin\Permission\RolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
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

    //查看某个角色的权限
    public function permission(AdminRole $role)
    {
        return $this->repository->permission($role);
    }

    //创建某个角色权限
    public function storePermission(StoreRolePermissionRequest $request, AdminRole $role)
    {
      return $this->repository->storePermission($request, $role);
    }
}
