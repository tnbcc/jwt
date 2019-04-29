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
                        return $fail(trans('api.role.is_exist'));
                    }
                }
            ],
            'description' => 'required|string'
        ];
    }


    public function attributes()
    {
        return [
            'name'           => trans('api.role.name'),
            'description'    => trans('api.role.description'),
        ];
    }
}
