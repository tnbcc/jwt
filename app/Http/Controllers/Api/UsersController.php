<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\Api\UserCollection;
use App\Http\Resources\Api\UserResource;
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
        return $this->success(new UserResource($user));
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
    public function login(Request $request)
    {


        if($token = \Auth::guard('api')->attempt(['name'=>$request->name, 'password'=>$request->password])) {

            return $this->setStatusCode(201)->success(['token' => 'bearer ' . $token]);

        }

        return $this->failed('账号或密码错误',400);
    }


    public function logout()
    {
      \Auth::guard('api')->logout();

      return $this->success('退出成功');
    }

   public function info()
   {

       $user = \Auth::guard('api')->user();

       return $this->success(new UserResource($user));
   }

}
