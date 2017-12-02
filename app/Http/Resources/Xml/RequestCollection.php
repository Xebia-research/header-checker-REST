<?php

namespace App\Http\Resources\Xml;

use App\Http\Resources\Types\Xml\ResourceCollection;

class RequestCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * PHP arrays can't have same-named keys, but XML can.
     * This wrapper renames your resource collection nicely.
     *
     * <data>
     *   <resource>
     *     <id>123</id>
     *   </resource>
     *   <resource>
     *     <id>456</id>
     *   </resource>
     * </data>
     *
     * @var string
     */
    public static $wrap = 'request';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
