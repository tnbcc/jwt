<?php

namespace App\Http\Requests\Api\Admin\Permission;

use App\Http\Requests\Request;
use App\Models\Admin\Permission\AdminRole;

class CreateRoleRequest extends Request
{

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:3',
                function ($attribute, $value, $fail) {
                    if ($name = AdminRole::where('name', $value)->first()) {
                        return $fail('该角色已经存在');
                    }
                }
            ],
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => '角色名称不能为空',
            'name.min'             => '角色最小长度为3',
            'description.required' => '角色描述不能为空',
            'description.string'   => '角色描述类型有误'
        ];
    }
}
