<?php

namespace App\Models\Admin\Permission;


use App\Models\BaseModel;

class AdminRoleUser extends BaseModel
{
    const TABLE = 'admin_role_user';

    protected $table = self::TABLE;
}
