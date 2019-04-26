<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

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

        //获取当前守护的名称
        $present_guard = \Auth::getDefaultDriver();

        if ($token = \Auth::claims(['guard' => $present_guard])->attempt(['name'=>$request->name, 'password'=>$request->password])) {


            $user = \Auth::user();

            if ($user->last_token) {
                try {

                    \Auth::setToken($user->last_token)->invalidate();

                } catch (TokenExpiredException  $e) {

                }
            }

            $user->last_token = $token;
            $user->save();

            return $this->setStatusCode(201)->success([
                'token' => 'bearer ' . $token,
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ]);

        }

        return $this->failed('账号或密码错误',400);
    }


    public function logout()
    {
      \Auth::logout();

      return $this->success('退出成功');
    }

   public function info()
   {

       $user = \Auth::user();

       return $this->success(new UserResource($user));
   }

}
