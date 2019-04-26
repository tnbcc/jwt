<?php

namespace App\Http\Controllers\Api\Admin\Permission;

use App\Http\Requests\Api\Admin\Permission\CreatePermissionRequest;
use App\Repositories\Admin\Permission\PermissionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    public function __construct(PermissionsRepository $repository)
    {
        $this->repository = $repository;
    }

    //权限列表
    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    //创建权限
    public function store(CreatePermissionRequest $request)
    {
        return $this->repository->store($request);
    }
}
