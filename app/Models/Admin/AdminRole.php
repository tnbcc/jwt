<?php

namespace App\Models\Admin;


use App\Models\BaseModel;

class AdminRole extends BaseModel
{
    const TABLE = 'admin_role';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description'
    ];

}