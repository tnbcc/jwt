<?php

Route::namespace('Api')->prefix('v1')->middleware(['cors'])->group(function () {
    Route::get('/users','UsersController@index')->name('users.index');
    Route::post('/login', 'UsersController@login')->name('users.login');
    Route::middleware('api.refresh')->group(function () {
        //当前用户信息
        Route::get('/users/info','UsersController@info')->name('users.info');
        //用户列表
        Route::get('/users','UsersController@index')->name('users.index');
        //用户信息
        Route::get('/users/{user}','UsersController@show')->name('users.show');
        //用户退出
        Route::get('/logout','UsersController@logout')->name('users.logout');
    });
});