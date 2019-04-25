<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()->paginate(3);

        return $this->success($users);
    }

    public function show(User $user)
    {
        return $this->success($user);
    }

    public function store(UserRequest $request)
    {
        try {
            User::create($request->all());

            return $this->setStatusCode(201)->success('注册成功');

        } catch (\Exception $e) {
            \Log::error('新建用户失败' . $e->getMessage(), [
                'data' => $request->all()
            ]);
            return $this->failed('新建用户失败');
        }
    }

        //用户登录
    public function login(Request $request){

        $result = \Auth::guard('web')->attempt(['name'=>$request->name,'password'=>$request->password]);

        if ($result) {
            return $this->setStatusCode(201)->success('用户登录成功');
        }
        return $this->failed('用户登录失败', 401);
    }

}
