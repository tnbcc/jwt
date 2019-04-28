<?php
namespace App\Repositories\Admin\Log;

use App\Models\Admin\Log\Log;
use App\Repositories\Admin\Permission\PermissionsRepository;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Zhuzhichao\IpLocationZh\Ip;

class LogsRepository extends BaseRepository
{
    protected $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function index(Request $request)
    {
        $pageSize = $request->input('pageSize', 20);

        $result =  Log::with('admin:id,name,status')
                        ->latest('created_at')
                        ->paginate($pageSize);

        return $this->success($result);
    }

    public function store(array $result)
    {
        try {

            Log::create($result);

        } catch (\Exception $e) {
            \Log::error('新建系统日志失败'.$e->getMessage(), [
                'data' => $result
            ]);
        }
    }

    public function destroy(Log $log)
    {
        try {

            $log->delete();

            return $this->setStatusCode(201)->success('删除系统日志成功');

        } catch (\Exception $e) {
           \Log::error('删除系统日志失败'.$e->getMessage(), [
              'log_id' => $log->id,
           ]);
           return $this->failed('删除系统日志失败', 400);
        }
    }


    /**
     * 登录操作日志
     * @param $request
     * @return mixed
     */
    public function loginActionLogCreate(Request $request,$status = false)
    {
        //获取当前登录管理员信息
        if (!$admin = \Auth::user()) {
            return $this->failed('账号异常');
        }

        $ip = $request->getClientIp();

        $address = Ip::find($ip);

        $action = $status ? "管理员: {$admin->name} 登录成功" : " 登录失败,登录的账号为：{$request->name}　密码为：{$request->password}";

        $data = [
            'ip'=> $ip,
            'address'=> $address[0].$address[1].$address[2],
            'action'=> $action,
        ];
        $result = [
            'admin_id' => $admin->id ? $admin->id : null,
            'data'     => $data,
            'type'     => 1,
        ];
        return $this->store($result);
    }


    /**
     * 后台操作日志
     * @param $request
     * @return mixed
     */
    public function mudelActionLogCreate(Request $request)
    {
        $path = \Route::currentRouteName();


        $rule = $this->permissionsRepository->ByRoute($path);

        if (is_null($rule)) return false;

        //获取当前操作方法上级模块名称
        if ($rule->parent_id != 0) {
            $parent_rule = $this->permissionsRepository->ById($rule->parent_id);
        }

        //获取当前登录管理员信息
        $admin = \Auth::user();

        $address = Ip::find($request->getClientIp());

        $action = "管理员: {$admin->name} 操作了 【{$parent_rule->name}】- {$rule->name} 模块";

        $data = [
            'ip'=> $request->getClientIp(),
            'address'=> $address[0].$address[1].$address[2],
            'action'=> $action,
        ];

        $result = [
            'admin_id' => isset($admin->id) ? $admin->id : null,
            'data'     => $data,
            'type'     => 1,
        ];

        return $this->store($result);
    }

}