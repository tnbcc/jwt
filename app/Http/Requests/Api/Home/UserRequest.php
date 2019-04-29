<?php

namespace App\Http\Requests\Api\Home;


use App\Http\Requests\Request;

class UserRequest extends Request
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
                        'name' => ['required', 'max:12', 'unique:users,name'],
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
            'id'      => trans('api.user.id'),
            'name'    => trans('api.user.name'),
        ];
    }
}
