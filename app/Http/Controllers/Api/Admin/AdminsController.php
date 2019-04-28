<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\Admin\AdminRequest;
use App\Http\Requests\Api\Admin\Permission\StoreRoleRequest;
use App\Http\Resources\Api\Admin\AdminResource;
use App\Jobs\Api\SaveLastTokenJob;
use App\Models\Admin\Admin;
use App\Models\Admin\Permission\AdminRole;
use App\Repositories\Admin\Log\LogsRepository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AdminsController extends Controller
{


    public function __construct(LogsRepository $repository)
    {
        $this->repository = $repository;
    }

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

        //获取当前守护的名称
        $present_guard = \Auth::getDefaultDriver();

        if ($token = \Auth::claims(['guard' => $present_guard])->attempt(['name'=>$request->name, 'password'=>$request->password])) {

            //如果登陆，先检查原先是否有存token，有的话先失效，然后再存入最新的token
            $user = \Auth::user();

            if ($user->last_token) {

                try {
                    \Auth::setToken($user->last_token)->invalidate();
                } catch (TokenExpiredException $e){
                    //因为让一个过期的token再失效，会抛出异常，所以我们捕捉异常，不需要做任何处理
                }
            }

            $this->dispatch(new SaveLastTokenJob($user, $token));

            //记录登录操作记录
            $this->repository->loginActionLogCreate($request,true);
            
            return $this->setStatusCode(201)->success([
                'token'      => 'bearer ' . $token,
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('admin')->factory()->getTTL()
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

        $admin = \Auth::user();

        return $this->success(new AdminResource($admin));
    }

    //管理员角色页面
    public function role(Request $request)
    {


        $pageSize = $request->input('pageSize', 10);

        $roles  = AdminRole::query()->paginate($pageSize);

        //当前用户角色
        $myRole = \Auth::user()->roles;

        $data = [
            'roles'       => $roles,
            'myRole'      => $myRole,
            'admin_id'  => \Auth::user()->id,
        ];

        return $this->setStatusCode(201)->success($data);
    }

    //创建管理员角色
    public function storeRole(StoreRoleRequest $request)
    {

       try {
           $ids = $request->input('roles');

          \Auth::user()->roles()->sync($ids);

           return $this->setStatusCode(201)->success('创建管理员角色成功');

       } catch (\Exception $e) {
           \Log::error('创建管理员角色失败'.$e->getMessage(), [
               'data' => $ids,
           ]);
           return $this->failed('创建管理员失败', 400);
       }

    }
}