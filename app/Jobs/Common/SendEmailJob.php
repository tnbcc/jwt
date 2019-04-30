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
             \Log::info('xxx', [
                 'emails' => $this->emails
             ]);
             Mail::to($this->emails)->send(new SendEmailTest());
         } catch (\Exception $e) {
             \Log::error(trans('api.email.failed').$e->getMessage(), [
                 'emails' => $this->emails
             ]);
         }
    }
}
