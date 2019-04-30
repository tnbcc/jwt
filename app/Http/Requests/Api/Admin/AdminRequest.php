<?php

namespace App\Http\Requests\Api\Admin;

use App\Http\Requests\Request;

class AdminRequest extends Request
{

    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
                {
                    return [
                        'id' => ['required,exists:shop_user,id']
                    ];
                }
            case 'POST':
                {
                    return [
                        'name'     => ['required', 'max:12', 'unique:admins,name'],
                        'password' => ['required', 'max:16', 'min:6']
                    ];
                }
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
            default:
                {
                    return [

                    ];
                }
        }
    }

    public function attributes()
    {
        return [
            'id'      => trans('api.admin.id'),
            'name'    => trans('api.admin.name'),
        ];
    }
}
