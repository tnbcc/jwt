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
                             return $fail(trans('api.roles.no_exist'));
                         }
                     }
                }
            ]

        ];
    }

    public function attributes()
    {
        return [
            'roles' => trans('api.roles.one')
        ];
    }
}
