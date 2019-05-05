<?php

namespace App\Listeners;

use ArrayObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Foundation\Http\Events\RequestHandled;

class SetResponseEncodingOptions
{
    /*...*/
    public function handle(RequestHandled $event)
    {
        $content = $event->response->original;

        if ($content instanceof Arrayable ||
            $content instanceof Jsonable ||
            $content instanceof ArrayObject ||
            $content instanceof \JsonSerializable ||
            is_array($content)) {
            $event->response->setContent(json_encode($content, \JSON_UNESCAPED_UNICODE));
        }
    }
}