<?php

namespace App\Http\Requests\Api\Admin\Permission;


use App\Http\Requests\Request;
use App\Models\Admin\Permission\AdminPermission;

class CreatePermissionRequest extends Request
{

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:3',
                function ($attribute, $value, $fail) {
                    if ($name = AdminPermission::where('name', $value)->first()) {
                        return $fail('该权限已经存在');
                    }
                }
            ],
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => '权限名称不能为空',
            'name.min'             => '权限最小长度为3',
            'description.required' => '权限描述不能为空',
            'description.string'   => '权限描述类型有误'
        ];
    }
}
