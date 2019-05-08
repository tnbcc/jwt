<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Mongo extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'age'
    ];

}
