<?php
namespace App\Traits\Common;

trait GetStatusAttribute
{
    public function getStatusAttribute()
    {
        return self::$userStatusMap[$this->attributes['status']];
    }
}