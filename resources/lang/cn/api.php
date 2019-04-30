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
        'name' => '用户名'
    ],
    'permission' => [
        'name' => '权限名称',
        'description' => '权限描述',
        'is_exist'    => '该权限已经存在'
    ],
    'role' => [
        'name' => '角色名称',
        'description' => '角色描述',
        'is_exist'    => '该角色已经存在'
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
        'name' => '管理员'
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
    ]
];