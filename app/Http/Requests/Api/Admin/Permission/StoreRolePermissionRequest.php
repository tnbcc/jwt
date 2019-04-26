<?php

namespace App\Http\Requests\Api\Admin\Permission;


use App\Http\Requests\Request;

class StoreRolePermissionRequest extends Request
{


    public function rules()
    {
        return [
            'permissions' => 'array|required'
        ];
    }

    public function messages()
    {
        return [
            'permissions.required' =>'不能为空',
            'permissions.array'    =>'格式必须为数组',
        ];
    }
}
