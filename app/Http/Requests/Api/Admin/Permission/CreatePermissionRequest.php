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
                        return $fail(trans('api.permission.is_exist'));
                    }
                }
            ],
            'description' => 'required|string',
            'parent_id' => 'integer',
        ];
    }

    public function attributes()
    {
        return [
            'name'           => trans('api.permission.name'),
            'description'    => trans('api.permission.description'),
        ];
    }
}
