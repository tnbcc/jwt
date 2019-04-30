<?php

namespace App\Http\Controllers\Api\Admin\Common;

use App\Http\Controllers\Api\Admin\AdminBaseController;
use App\Services\Common\EmailService;
use Illuminate\Http\Request;


class EmailController extends AdminBaseController
{
     protected $emailService;

     public function __construct(EmailService $emailService)
     {
         $this->emailService = $emailService;
     }

    public function send(Request $request)
     {

        return $this->emailService->send($request);
     }
}
