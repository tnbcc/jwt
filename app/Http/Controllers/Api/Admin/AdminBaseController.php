<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Traits\Api\ApiResponse;

class AdminBaseController extends BaseController
{
    use ApiResponse;

    protected $repository;
}
