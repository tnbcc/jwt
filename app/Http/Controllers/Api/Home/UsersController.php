<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Requests\Api\Home\UserRequest;
use App\Models\Home\User;
use App\Repositories\Home\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends HomeBaseController
{
    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function show(User $user)
    {
        return $this->repository->show($user);
    }

    public function store(UserRequest $request)
    {
        return $this->repository->store($request);
    }

    //用户登录
    public function login(Request $request)
    {
        return $this->repository->login($request);
    }


    public function logout()
    {
       return $this->repository->logout();
    }

   public function info()
   {
       return $this->repository->info();
   }

}
