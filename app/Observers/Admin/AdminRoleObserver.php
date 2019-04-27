<?php

namespace App\Observers\Admin;

class AdminRoleObserver
{
    /**
     * 删除角色事件
     */
    public function deleting()
    {
        return \Cache::tags('rbac')->flush();
    }
}
