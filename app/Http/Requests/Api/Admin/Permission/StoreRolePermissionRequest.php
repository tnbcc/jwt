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
                              return $fail(trans('api.permissions.no_exist'));
                          }
                      }
                }
            ]
        ];
    }

    public function attributes()
    {
        return [
            'permissions' => trans('api.permissions.one'),
        ];
    }
}
