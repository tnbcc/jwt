<?php
use Illuminate\Http\Request;

Route::namespace('Api')->prefix('v1')->middleware('cors')->group(function () {

    Route::middleware('api.guard')->group(function () {
        //用户注册
        Route::post('/users','UsersController@store')->name('users.store');
        //用户登录
        Route::post('/login','UsersController@login')->name('users.login');
        Route::middleware('api.refresh')->group(function () {
            //用户退出
            Route::get('/logout','UsersController@logout')->name('users.logout');
            //当前用户信息
            Route::get('/users/info','UsersController@info')->name('users.info');
            //用户列表
            Route::get('/users','UsersController@index')->name('users.index');
            //用户信息
            Route::get('/users/{user}','UsersController@show')->name('users.show');

        });
    });


    Route::namespace('Admin')->middleware('admin.guard')->group(function () {
        //管理员注册
        Route::post('/admins', 'AdminsController@store')->name('admins.store');
        //管理员登录
        Route::post('/admin/login', 'AdminsController@login')->name('admins.login');
        Route::middleware(['admin.refresh', 'rbac'])->group(function () {

            //管理员角色列表
            Route::get('/admins/role', 'AdminsController@role')->name('admins.role');
            //赋予某个用户角色
            Route::post('/admins/role', 'AdminsController@storeRole')->name('admins.store.role');
            //管理员退出
            Route::get('/admins/logout', 'AdminsController@logout')->name('admins.logout');
            //当前管理员信息
            Route::get('/admins/info', 'AdminsController@info')->name('admins.info');
            //管理员列表
            Route::get('/admins', 'AdminsController@index')->name('admins.index');
            //管理员信息
            Route::get('/admins/{admin}', 'AdminsController@show')->name('admins.show');




            //权限管理
            Route::namespace('Permission')->group(function () {
                //角色列表
                Route::get('roles', 'RolesController@index')->name('roles.index');
                //创建角色
                Route::post('roles', 'RolesController@store')->name('roles.store');
                //某个角色的权限
                Route::get('roles/{role}/permission', 'RolesController@permission')->name('roles.permission');
                //给某个角色赋予权限
                Route::post('roles/{role}/permission', 'RolesController@storePermission')->name('roles.store_permission');
                //权限列表
                Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
                //创建权限
                Route::post('permissions', 'PermissionsController@store')->name('permissions.store');
            });


        });

    });

});