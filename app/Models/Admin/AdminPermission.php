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
}
