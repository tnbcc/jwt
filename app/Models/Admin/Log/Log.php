<?php

namespace App\Models\Admin\Log;


use App\Models\Admin\Admin;
use App\Models\BaseModel;

class Log extends BaseModel
{
    const TABLE = 'log';

    protected $table = self::TABLE;

    protected $fillable = [
        'data'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
