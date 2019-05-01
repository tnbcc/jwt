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

            $flag = dispatch(new SendEmailJob($emails));

            if ($flag) {
                return $this->success(trans('api.email.success'));
            }

        } catch (\Exception $e) {
           \Log::error(trans('api.email.failed').$e->getMessage(), [
               'emails' => $emails
           ]);
           return $this->failed(trans('api.email.failed'), 400);
        }


    }
}