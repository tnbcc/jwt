<?php
namespace App\Repositories\Admin\Permission;

use App\Http\Requests\Api\Admin\Permission\CreatePermissionRequest;
use App\Models\Admin\Permission\AdminPermission;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class PermissionsRepository extends BaseRepository
{
    public function index(Request $request)
    {
       $pageSize = $request->input('pageSize', 20);

       $permissions = AdminPermission::query()->paginate($pageSize);

       return $this->success($permissions);
    }

    public function store(CreatePermissionRequest $request)
    {
       try {
           AdminPermission::create($request->all());

           return $this->setStatusCode(201)->success(trans('api.permission.create.success'));

       } catch (\Exception $e) {
           \Log::error(trans('api.create.permission.failed').$e->getMessage(), [
               'data' => $request->all()
           ]);
           return $this->failed(trans('api.create.permission.failed'));
       }
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return AdminPermission::find($id);
    }

    /**
     * 根据路由名称获取路由的详细信息
     * @param $route
     * @return mixed
     */
    public function ByRoute($route)
    {
        return AdminPermission::where('route', $route)->first();
    }

    /**
     * 获取全部权限只限显示的数据
     * @return mixed
     */
    public function getRulesAndPublic()
    {
        return AdminPermission::query()->oldest('sort')->public()->get();
    }

    /**
     * 获取全部权限
     * @return mixed
     */
    public function getRules()
    {
        return AdminPermission::query()->oldest('sort')->get();
    }
}