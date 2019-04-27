<?php

namespace App\Observers\Admin;

class AdminPermissionObserver
{
    public function saving()
    {
        return \Cache::tags('rbac')->flush();
    }

    public function deleting()
    {
        return \Cache::tags('rbac')->flush();
    }
}
