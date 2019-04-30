<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2019/4/29
 * Time: 下午11:07
 */

return [
    'success' => [
        'excel_export' => 'export success',
    ],
    'failed' => [
        'excel_export' => 'export failed',
    ],
    'user' => [
        'id'   => 'user id',
        'name' => 'username'
    ],
    'permission' => [
        'name' => 'permission name',
        'description' => 'permission description',
        'is_exist'    => 'The permission already exists'
    ],
    'role' => [
        'name' => 'role name',
        'description' => 'role description',
        'is_exist'    => 'The role already exists'
    ],
    'permissions' => [
        'one' => 'permission',
        'no_exist' => 'Please check whether there is no permission'
    ],
    'roles' => [
        'one' => 'role ID',
        'no_exist' => 'The role already exists',
    ],
    'admin' => [
        'id' => 'manager id',
        'name' => 'manager'
    ],
    'exception' => [
        '401' => 'unauthorized',
        '404' => 'This model is not found',
        '403' => 'Without the permission',
        '422' => 'Not login or login failed',
        '400' => 'Token failed',
        'not_find' => 'This page not found',
        '405'      => 'Access method is wrong',
        '500'      => 'Server error'
    ],
    'auth' => [
        'no_permission' => 'no access'
    ]
];