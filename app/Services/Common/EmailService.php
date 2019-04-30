<?php
namespace App\Services\Common;

use App\Jobs\Common\SendEmailJob;
use App\Traits\Api\ApiResponse;
use Illuminate\Http\Request;

class EmailService
{
    use ApiResponse;

    public function send(Request $request)
    {

        $emails = $request->input('emails');


        try {

            dispatch(new SendEmailJob($emails));

            return $this->success(trans('api.email.success'));

        } catch (\Exception $e) {
           \Log::error(trans('api.email.failed').$e->getMessage(), [
               'emails' => $emails
           ]);
           return $this->failed(trans('api.email.failed'), 400);
        }


    }
}