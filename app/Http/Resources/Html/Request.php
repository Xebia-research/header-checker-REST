<?php

namespace App\Http\Resources\Html;

use App\Http\Resources\Types\Html\Resource;

class Request extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
