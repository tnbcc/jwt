<?php

namespace App\Jobs\Api;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SaveLastTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;
    protected $token;

    public function __construct($model, $token)
    {
        $this->token = $token;
        $this->model = $model;
    }


    public function handle()
    {
       $this->model->last_token = $this->token;

       $this->model->save();
    }
}
