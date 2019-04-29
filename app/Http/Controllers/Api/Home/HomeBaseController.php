<?php

namespace App\Http\Controllers\Api\Home;

use App\Traits\Api\ApiResponse;
use App\Http\Controllers\Controller as BaseController;

class HomeBaseController extends BaseController
{
    use ApiResponse;
    protected $repository;
}
