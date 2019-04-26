<?php

namespace App\Http\Requests\Api\Admin\Permission;


use App\Http\Requests\Request;

class StoreRoleRequest extends Request
{

    public function rules()
    {
        return [
            'roles' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'roles.required' =>'角色ID不能为空',
            'roles.array'    =>'格式必须为数组',
        ];
    }
}
