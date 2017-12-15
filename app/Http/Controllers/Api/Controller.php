<?php

namespace App\Http\Controllers\Api;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected const FORMAT_XML = 'xml';
    protected const FORMAT_JSON = 'json';
    protected const FORMAT_HTML = 'html';

    /**
     * @param  mixed  $resource
     * @param  null|string  $format
     * @return \App\Http\Resources\Html\Request|\App\Http\Resources\Json\Request|\App\Http\Resources\Xml\Request
     */
    protected function singleResourceResponse($resource, ?string $format)
    {
        if ($format == static::FORMAT_HTML) {
            return new \App\Http\Resources\Html\Request($resource);
        } elseif ($format == static::FORMAT_XML) {
            return new \App\Http\Resources\Xml\Request($resource);
        } else {
            return new \App\Http\Resources\Json\Request($resource);
        }
    }

    /**
     * @param  mixed  $resources
     * @param  null|string  $format
     * @return \App\Http\Resources\Html\RequestCollection|\App\Http\Resources\Json\RequestCollection|\App\Http\Resources\Xml\RequestCollection
     */
    protected function resourceCollectionResponse($resources, ?string $format)
    {
        if ($format == static::FORMAT_HTML) {
            return new \App\Http\Resources\Html\RequestCollection($resources);
        } elseif ($format == static::FORMAT_XML) {
            return new \App\Http\Resources\Xml\RequestCollection($resources);
        } else {
            return new \App\Http\Resources\Json\RequestCollection($resources);
        }
    }
}
