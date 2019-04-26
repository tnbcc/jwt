<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\Admin\AdminRequest;
use App\Http\Resources\Api\Admin\AdminResource;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = Admin::query()->paginate(3);

        return $this->success($admins);
    }

    public function show(Admin $admin)
    {
        return $this->success(new AdminResource($admin));
    }

    public function store(AdminRequest $request)
    {
        try {
            Admin::create($request->all());

            return $this->setStatusCode(201)->success('注册成功');

        } catch (\Exception $e) {
            \Log::error('新建管理员失败' . $e->getMessage(), [
                'data' => $request->all()
            ]);
            return $this->failed('新建管理员失败');
        }
    }

    //管理员登录
    public function login(Request $request)
    {


        if ($token = \Auth::guard('admin')->attempt(['name'=>$request->name, 'password'=>$request->password])) {

            return $this->setStatusCode(201)->success([
                'token'      => 'bearer ' . $token,
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('admin')->factory()->getTTL() * 60
            ]);

        }

        return $this->failed('账号或密码错误',400);
    }


    public function logout()
    {
        \Auth::guard('admin')->logout();

        return $this->success('退出成功');
    }

    public function info()
    {

        $admin = \Auth::guard('admin')->user();

        return $this->success(new AdminResource($admin));
    }

}