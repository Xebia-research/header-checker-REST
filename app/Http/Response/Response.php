<?php

namespace App\Http\Response;

use Illuminate\Http\Request;

class Response
{
    private const CONTENT_TYPE_JSON = 'application/json';
    private const CONTENT_TYPE_XML = 'application/xml';

    /**
     * The current Request.
     *
     * @var Request
     */
    private $request;

    /**
     * The Content-Type.
     *
     * @var string
     */
    private $contentType;

    /**
     * Set the request.
     *
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        $this->setContentType($this->request->header('Content-Type', 'application/json'));
    }

    /**
     * Set the Content-Type.
     *
     * @param string $contentType
     */
    private function setContentType(string $contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * Respond with Request.
     *
     * @param $resource
     * @return \App\Http\Resources\Json\Request|\App\Http\Resources\Xml\Request
     */
    public function singleResourceResponse($resource)
    {
        switch ($this->contentType) {
            case static::CONTENT_TYPE_XML:
                return new \App\Http\Resources\Xml\Request($resource);

            default:
            case static::CONTENT_TYPE_JSON:
                return new \App\Http\Resources\Json\Request($resource);
        }
    }

    /**
     * Respond with RequestCollection.
     *
     * @param $resources
     * @return \App\Http\Resources\Json\RequestCollection|\App\Http\Resources\Xml\RequestCollection
     */
    public function resourceCollectionResponse($resources)
    {
        switch ($this->contentType) {
            case static::CONTENT_TYPE_XML:
                return new \App\Http\Resources\Xml\RequestCollection($resources);

            default:
            case static::CONTENT_TYPE_JSON:
                return new \App\Http\Resources\Json\RequestCollection($resources);
        }
    }
}