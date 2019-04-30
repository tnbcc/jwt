<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravel-api

基于**Laravel5.7** 开发

## 前言
基于 [laravel5.7](http://www.laravel.com/)开发.
授权、鉴权采用 [jwt](https://github.com/tymondesigns/jwt-auth)

## 功能

### RBAC权限管理
- [x] 中间件 - 判断当前用户是否有权限操作(redis缓存用户拥有的权限)
- [x] 管理员管理 - 添加、编辑、删除、禁用；
- [x] 角色管理 
- [x] 权限管理 
- [x] 操作日志


## 安装

> 目前为 v1.0版本

### 1.克隆源码到本地
> git clone https://github.com/tnbcc/jwt.git

### 2.进入项目目录
> cd jwt

### 3.给目录权限
> chmod -R 777 storage bootstrap

### 4. 拷贝`.env`文件
一些 `secret key` 改成自己服务的`key`即可
> cp .env.example .env

### 5. 安装扩展包依赖
下载`laravel`相关依赖的包

> composer install

### 6. 生成秘钥
> php artisan key:generate

### 7.生成JWT秘钥
> php artisan jwt:secret 

### 8.执行迁移文件
> php artisan migrate 

### 9.自行根据route/api.php 路由 用postman自行访问

欢迎大家 PR 如果对你有帮助可以点个小star  本人邮箱：tniub.cc@gmail.com
