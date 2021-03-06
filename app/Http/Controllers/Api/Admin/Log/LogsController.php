<?php

namespace App\Http\Controllers\Api\Admin\Log;

use App\Http\Controllers\Api\Admin\AdminBaseController;
use App\Models\Admin\Log\Log;
use App\Repositories\Admin\Log\LogsRepository;
use Illuminate\Http\Request;

class LogsController extends AdminBaseController
{

    public function __construct(LogsRepository $repository)
    {
        $this->repository = $repository;
    }

    //get
    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    //get
    public function create()
    {

    }

    //post
    public function store()
    {

    }

    //get
    public function show(Log $log)
    {

    }

    //get
    public function edit(Log $log)
    {

    }

    //put
    public function update(Log $log)
    {

    }

    //delete
    public function destroy(Log $log)
    {
       return $this->repository->destroy($log);
    }
}
