<?php
namespace App\Repositories\Admin\Permission;

use App\Handlers\Tree;
use App\Http\Requests\Api\Admin\Permission\StoreRolePermissionRequest;
use App\Models\Admin\Permission\AdminPermission;
use App\Models\Admin\Permission\AdminRole;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class RolesRepository extends BaseRepository
{
    public function index(Request $request)
    {
        $pageSize = $request->input('pageSize', 20);
        $roles = AdminRole::query()->with('permissions')->paginate($pageSize);

        return $this->success($roles);
    }

    public function store(Request $request)
    {

        try {

            AdminRole::create($request->all());

            return $this->success('创建角色成功');

        } catch (\Exception $e) {
          \Log::error('创建角色失败'.$e->getMessage(), [
              'data' => $request->all()
          ]);
         return $this->failed('创建角色失败', 400);
        }
    }

    public function permission(AdminRole $role, PermissionsRepository $permissionsRepository, Tree $tree)
    {
       //获取所有权限
        $permissions = $tree::channelLevel($permissionsRepository->getRules(), 0, '&nbsp;', 'id','parent_id');
       //获取当前角色的权限
        $myPermission = $role->permissions->pluck('id');

        $data = [
            'permissions'  => $permissions,
            'myPermission' => $myPermission,
            //'role'         => $role
        ];

        return $this->success($data);
    }

    public function storePermission(StoreRolePermissionRequest $request, AdminRole $role)
    {
        try {
            $permissions   = AdminPermission::findMany($request->input('permissions'));

            $myPermissions = $role->permissions;

            //增加的
            $addPermission = $permissions->diff($myPermissions);

            $addPermission->each(function (AdminPermission $permission) use ($role) {
                $role->grantPermission($permission);
            });

            //要删除的
            $deletePermission = $myPermissions->diff($permissions);

            $deletePermission->each(function (AdminPermission $permission) use ($role) {
                $role->deletePermission($permission);
            });
            $this->success('授权成功');
        } catch (\Exception $e) {
             \Log::error('授权失败'.$e->getMessage(), [
                'data' => $permissions,
             ]);
             return $this->failed('授权失败', 400);
        }

    }
}