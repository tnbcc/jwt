<?php

namespace App\Observers\Admin;

use App\Models\Admin\Admin;

class AdminObserver
{
    /**
     * @param Admin $admin
     */
    public function updating(Admin $admin)
    {
        $admin->clearRuleAndMenu();
    }


    public function deleting(Admin $admin)
    {
        $admin->clearRuleAndMenu();
    }
}
