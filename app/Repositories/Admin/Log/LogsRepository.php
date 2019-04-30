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

        $data =  Log::with('admin:id,name,status')
                        ->latest()
                        ->paginate($pageSize)->toArray();
        $result = SplitData($data);

        return $this->success($result);
    }

    public function store(array $result)
    {
        try {

            Log::create($result);

            return $this->setStatusCode(201)->success(trans('api.log.system_store.success'));

        } catch (\Exception $e) {
            \Log::error(trans('api.log.system_store.failed').$e->getMessage(), [
                'data' => $result
            ]);
            return $this->failed(trans('api.log.system_store.failed'), 400);
        }
    }

    public function destroy(Log $log)
    {
        try {

            $log->delete();

            return $this->success(trans('api.log.system_delete.success'));

        } catch (\Exception $e) {
           \Log::error(trans('api.log.system_delete.failed').$e->getMessage(), [
              'log_id' => $log->id,
           ]);
           return $this->failed(trans('api.log.system_delete.failed'), 400);
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
            return $this->failed(trans('api.account.abnormal'), 400);
        }

        $ip = $request->getClientIp();

        $address = Ip::find($ip);

        $action = $status ? trans('api.log.system_log.manage').": {$admin->name} ".trans('api.log.system_log.login_success') :trans('api.log.system_log.login_failed') ." ：{$request->name}".trans('api.log.system_log.password')."：{$request->password}";

        $data = [
            'ip'=> $ip,
            'address'=> $address[0] == $address[1] ? $address[0].$address[2] : $address[0].$address[1].$address[2],
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


        $action = trans('api.log.system_log.manage').": {$admin->name} ".trans('api.log.system_log.operation')." 【{$parent_rule->name}】- {$rule->name} ".trans('api.log.system_log.module');

        $data = [
            'ip'=> $request->getClientIp(),
            'address'=> $address[0] == $address[1] ? $address[0].$address[2] : $address[0].$address[1].$address[2],
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