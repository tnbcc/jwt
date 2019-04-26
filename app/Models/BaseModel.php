<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'deleted_at',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public static function GetDBPrefix(){
        return config('database.connections.mysql.prefix');
    }

}
