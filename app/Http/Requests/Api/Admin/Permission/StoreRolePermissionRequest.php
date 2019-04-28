<?php

namespace App\Http\Requests\Api\Admin\Permission;


use App\Http\Requests\Request;
use App\Models\Admin\Permission\AdminPermission;

class StoreRolePermissionRequest extends Request
{


    public function rules()
    {
        return [
            'permissions' => [
                'required',
                'array',
                function($attribute, $value, $fail) {
                      foreach ($value as $item) {
                          if (!AdminPermission::query()->find($item)) {
                              return $fail('id为'. $item .'的'. $attribute .'不存在');
                          }
                      }
                }
            ]
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
