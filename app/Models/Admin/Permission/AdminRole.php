<?php

namespace App\Models\Admin\Permission;


use App\Models\BaseModel;

class AdminRole extends BaseModel
{
    const TABLE = 'admin_role';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description'
    ];

    //当前角色的所有权限

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_permission_role', 'role_id', 'permission_id')
                    ->withPivot(['permission_id', 'role_id']);
    }

    //给角色赋予某个权限
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    //取消角色赋予的权限
    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    //判断角色是否有权限
    public function hasPermission($permission)
    {
        return $this->permissions->contains($permission);
    }

    /**
     * 获取显示的权限
     * @return mixed
     */
    public function permissionsPublic()
    {
        return $this->permissions()->public()->orderBy('sort','asc')->get();
    }


}