<?php

namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\Resource;

class Endpoint extends Resource
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
            'url' => $this->url,
            'method' => $this->method,
        ];
    }
}
