<?php

namespace App\Models\Home;

use App\Traits\Common\GetStatusAttribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, GetStatusAttribute;


    const USER_STATUS_DELETED = -1;
    const USER_STATUS_NORMAL  = 0;
    const USER_STATUS_FREEZE  = 1;


    public static $userStatusMap = [
        self::USER_STATUS_DELETED => '已删除',
        self::USER_STATUS_NORMAL  => '正常',
        self::USER_STATUS_FREEZE  => '冻结'
    ];


    protected $fillable = [
        'name', 'password',
    ];


    protected $hidden = [
        'password', 'last_token'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
