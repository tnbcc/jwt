<?php

namespace App\Models\Admin\Permission;


use App\Models\BaseModel;

class AdminPermission extends BaseModel
{
    const TABLE = 'admin_permission';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'route',
        'parent_id',
        'is_hidden',
        'sort',
        'status',
        'fonts'
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
        'status'    => 'boolean',
    ];

    //权限属于哪个角色
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_permission_role', 'permission_id', 'role_id')
                    ->withPivot(['permission_id', 'role_id']);
    }

    /**
     * 只获取显示的数据
     * @param $query
     * @return mixed
     */
    public function scopePublic($query)
    {
        return $query->where('is_hidden', false);
    }
}
