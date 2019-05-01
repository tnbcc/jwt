<?php

namespace App\Jobs\Common;

use App\Mail\SendEmailTest;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emails;

    public function __construct($emails)
    {
        $this->emails = $emails;
    }

    public function handle()
    {

         try {
             $flag = Mail::send('emails.default',['name'=>'初三在读'],function($message){
                 $to = '1072155122@qq.com';
                 $message ->to($to)->subject('测试邮件');
             });
             return $flag;
         } catch (\Exception $e) {
             \Log::error(trans('api.email.failed').$e->getMessage(), [
                 'emails' => $this->emails
             ]);
         }
    }
}
