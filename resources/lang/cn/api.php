<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2019/4/29
 * Time: 下午11:04
 */

return [
    'success' => [
        'excel_export' => '导出成功',
    ],
    'failed' => [
        'excel_export' => '导出失败',
    ],
    'user' => [
        'id'   => '用户ID',
        'name' => '用户名',
        'store' => [
            'success' => '新建用户成功',
            'failed'  => '新建用户失败'
        ],

    ],
    'permission' => [
        'name' => '权限名称',
        'description' => '权限描述',
        'is_exist'    => '该权限已经存在',
        'create'      => [
            'success' => '创建权限成功',
            'failed'  => '创建权限失败'
        ]
    ],
    'role' => [
        'name' => '角色名称',
        'description' => '角色描述',
        'is_exist'    => '该角色已经存在',
        'create'      => [
            'success' => '创建角色成功',
            'failed'  => '创建角色失败'
        ],
        'authorize'   => [
            'success' => '授权成功',
            'failed'  => '授权失败'
        ],
    ],
    'permissions' => [
        'one' => '权限',
        'no_exist' => '请检查是否有不存在权限'
    ],
    'roles' => [
        'one' => '角色ID',
        'no_exist' => '角色不存在',
    ],
    'admin' => [
        'id' => '管理员ID',
        'name' => '管理员',
        'store' => [
            'success' => '注册管理员成功',
            'failed'  => '注册管理员失败'
        ],
        'role' => [
            'success' => '创建管理员角色成功',
            'failed'  => '创建管理员角色失败'
        ]
    ],
    'exception' => [
        '401' => '未授权',
        '404' => '该模型未找到',
        '403' => '没有此权限',
        '422' => '未登录或登录状态已失效',
        '400' => 'token不正确',
        'not_find' => '没有找到该页面',
        '405'      => '访问方式不对',
        '500'      => '服务器错误'
    ],
    'auth' => [
        'no_permission' => '无权访问'
    ],

    'account' => [
        'failed'   => '账号密码错误',
        'abnormal' => '账号异常'
    ],
    'logout' => [
        'success' => '退出成功',
        'failed'  => '退出失败'
    ],
    'status' => [
        'deleted' => '已删除',
        'normal'  => '正常',
        'freeze'  => '冻结'
    ],
    'log' => [
        'system_store' => [
            'success' => '新建系统日志成功',
            'failed'  => '新建系统日志失败'
        ],
        'system_delete' => [
            'success' => '删除系统日志成功',
            'failed'  => '删除系统日志失败'
        ],
        'system_log'  => [
            'manage' => '管理员',
            'login_success' => '登录成功',
            'login_failed'  => '登录失败,登录的账号为',
            'password'      => '密码为',
            'operation'     => '操作了',
            'module'        => '模块'
        ]
    ]

];