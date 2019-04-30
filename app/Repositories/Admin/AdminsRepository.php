<?php
namespace App\Repositories\Admin;

use App\Http\Requests\Api\Admin\AdminRequest;
use App\Http\Requests\Api\Admin\Permission\StoreRoleRequest;
use App\Http\Resources\Api\Admin\AdminResource;
use App\Jobs\Api\SaveLastTokenJob;
use App\Models\Admin\Admin;
use App\Models\Admin\Permission\AdminRole;
use App\Repositories\Admin\Log\LogsRepository;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AdminsRepository extends BaseRepository
{
    protected $logsRepository;

    public function __construct(LogsRepository $logsRepository)
    {
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        $pageSize = $request->input('pageSize', 20);

        $admins = Admin::query()->paginate($pageSize)->toArray();

        $result = SplitData($admins);

        return $this->success($result);
    }

    public function show(Admin $admin)
    {
        return $this->success(new AdminResource($admin));
    }

    public function store(AdminRequest $request)
    {
        try {
            Admin::create($request->all());

            return $this->setStatusCode(201)->success(trans('api.admin.store.success'));

        } catch (\Exception $e) {
            \Log::error(trans('api.admin.store.failed') . $e->getMessage(), [
                'data' => $request->all()
            ]);
            return $this->failed(trans('api.admin.store.failed'), 400);
        }
    }

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

            dispatch(new SaveLastTokenJob($user, $token));

            //记录登录操作记录
            $this->logsRepository->loginActionLogCreate($request,true);

            return $this->setStatusCode(201)->success([
                'token'      => 'bearer ' . $token,
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('admin')->factory()->getTTL()
            ]);

        }

        return $this->failed(trans('api.account.failed'),400);
    }

    public function logout()
    {
        \Auth::logout();

        return $this->success(trans('api.logout.success'));
    }

    public function info()
    {
        $admin = \Auth::user();

        return $this->success(new AdminResource($admin));
    }

    public function role(Request $request)
    {
        $pageSize = $request->input('pageSize', 10);

        $roles  = AdminRole::query()->paginate($pageSize)->toArray();

        $result = SplitData($roles);

        //当前用户角色
        $myRole = \Auth::user()->roles;

        $data = [
            'roles'       => $result,
            'myRole'      => $myRole,
            'admin_id'  => \Auth::user()->id,
        ];

        return $this->setStatusCode(201)->success($data);
    }

    public function storeRole(StoreRoleRequest $request)
    {
        try {
            $ids = $request->input('roles');

            \Auth::user()->roles()->sync($ids);

            return $this->setStatusCode(201)->success(trans('api.admin.role.success'));

        } catch (\Exception $e) {
            \Log::error(trans('api.admin.role.failed').$e->getMessage(), [
                'data' => $ids,
            ]);
            return $this->failed(trans('api.admin.role.failed'), 400);
        }
    }



}