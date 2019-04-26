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

           return $this->success('权限创建成功');

       } catch (\Exception $e) {
           \Log::error('权限创建失败'.$e->getMessage(), [
               'data' => $request->all()
           ]);
           return $this->failed('权限创建失败');
       }
    }
}