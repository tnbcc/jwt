<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'status'     => $this->status,
            'created_at' =>(string)$this->created_at,
            'updated_at' =>(string)$this->updated_at,
        ];
    }
}
