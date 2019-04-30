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
        'name' => 'username',
        'store' => [
            'success' => 'Create a user successfully',
            'failed'  => 'Failed to create a user'
        ],
    ],
    'permission' => [
        'name' => 'permission name',
        'description' => 'permission description',
        'is_exist'    => 'The permission already exists',
        'create'      => [
            'success' => 'Creating permission a successful',
            'failed'  => 'Create permission a failure'
        ]
    ],
    'role' => [
        'name' => 'role name',
        'description' => 'role description',
        'is_exist'    => 'The role already exists',
        'create'      => [
            'success' => 'Creating role a successful',
            'failed'  => 'Create role a failure'
        ],
        'authorize'   => [
            'success' => 'authorization successful',
            'failed'  => 'authorization failed '
        ]
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
        'name' => 'manager',
        'store' => [
            'success' => 'manager create success',
            'failed'  => 'manager create failed'
        ],
        'role' => [
            'success' => 'Create the administrator role a success',
            'failed'  => 'Create the administrator role a failed'
        ]
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
    ],
    'account' => [
        'failed'   => 'account is wrong',
        'abnormal' => 'account is abnormal'
    ],
    'logout' => [
        'success' => 'Exit the success',
        'failed'  => 'Exit the failed'
    ],
    'status' => [
        'deleted' => 'deleted',
        'normal'  => 'normal',
        'freeze'  => 'freeze'
    ],
    'log' => [
        'system_store' => [
            'success' => 'create system log success',
            'failed'  => 'create system log failed'
        ],
        'system_delete' => [
            'success' => 'delete system log success',
            'failed'  => 'delete system log failed'
        ],
        'system_log'  => [
            'manage'        => 'manage',
            'login_success' => 'login success',
            'login_failed'  => 'login failed login account for',
            'password'      => 'the password for',
            'operation'     => 'operation',
            'module'        => 'module'
        ]
    ],
    'emails' => [
        'success' => 'send email success',
        'failed'  => 'send email failed'
    ]
];