<?php

namespace App\Http\Controllers\Api\Admin\Permission;

use App\Repositories\Admin\Permission\RolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function __construct(RolesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }
}
