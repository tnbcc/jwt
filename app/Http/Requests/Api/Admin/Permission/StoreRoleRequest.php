<?php

namespace App\Http\Requests\Api\Admin\Permission;


use App\Http\Requests\Request;
use App\Models\Admin\Permission\AdminRole;

class StoreRoleRequest extends Request
{

    public function rules()
    {
        return [
            'roles' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                     foreach ($value as $v) {
                         if (!AdminRole::find($v)) {
                             return $fail('id为'. $v .'的角色不存在');
                         }
                     }
                }
            ]

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
