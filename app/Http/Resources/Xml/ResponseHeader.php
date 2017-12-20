<?php

namespace App\Http\Resources\Xml;

use App\Http\Resources\Types\Xml\Resource;

class ResponseHeader extends Resource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * PHP arrays can't have same-named keys, but XML can.
     * This wrapper renames your single resource nicely.
     *
     * <data>
     *   <resource>
     *     <id>123</id>
     *   </resource>
     * </data>
     *
     * @var string
     */
    public static $wrap = 'response_header';

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
