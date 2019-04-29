<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\Admin\AdminRequest;
use App\Http\Requests\Api\Admin\Permission\StoreRoleRequest; 
use App\Models\Admin\Admin;
use App\Repositories\Admin\AdminsRepository;
use Illuminate\Http\Request;

class AdminsController extends AdminBaseController
{

    public function __construct(AdminsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function show(Admin $admin)
    {
        return $this->repository->show($admin);
    }

    public function store(AdminRequest $request)
    {
        return $this->repository->store($request);
    }

    //管理员登录
    public function login(Request $request)
    {
        return $this->repository->login($request);
    }


    public function logout()
    {
        return $this->repository->logout();
    }

    public function info()
    {
        return $this->repository->info();
    }

    //管理员角色页面
    public function role(Request $request)
    {
        return $this->repository->role($request);
    }

    //创建管理员角色
    public function storeRole(StoreRoleRequest $request)
    {
        return $this->repository->storeRole($request);
    }
}