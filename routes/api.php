<?php
use Illuminate\Http\Request;

Route::namespace('Api')->prefix('v1')->middleware(['cors'])->group(function () {
    Route::get('/users','UsersController@index')->name('users.index');
    Route::get('/users/{user}','UsersController@show')->name('users.show');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::post('/login', 'UsersController@login')->name('users.login');
});