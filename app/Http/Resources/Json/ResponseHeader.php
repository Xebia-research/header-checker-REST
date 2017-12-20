<?php

namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\Resource;

class ResponseHeader extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
