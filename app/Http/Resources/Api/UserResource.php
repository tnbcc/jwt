<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {


        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'status'     => User::$userStatusMap[$this->status],
            'created_at' =>(string)$this->created_at,
            'updated_at' =>(string)$this->updated_at,
        ];
    }
}