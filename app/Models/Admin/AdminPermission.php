<?php

namespace App\Models\Admin;


use App\Models\BaseModel;

class AdminPermission extends BaseModel
{
    const TABLE = 'admin_permission';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description'
    ];

    //权限属于哪个角色
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_permission_role', 'permission_id', 'role_id')
                    ->withPivot(['permission_id', 'role_id']);
    }
}
