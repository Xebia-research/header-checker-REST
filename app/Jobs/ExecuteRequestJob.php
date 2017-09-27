<?php

namespace App\Jobs;

use App\Parsers\RequestHeaderParser;
use App\Response;
use App\ResponseHeader;

class ExecuteRequestJob extends Job
{
    /**
     * The request that should be executed.
     *
     * @var \App\Request
     */
    private $request;

    /**
     * ExecuteRequestJob constructor.
     *
     * @param \App\Request $request
     */
    public function __construct(\App\Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $endpoint = $this->request->endpoint;

        $requestHeaderParser = new RequestHeaderParser;
        $requestHeaderParser->setMethod($endpoint->method);
        $requestHeaderParser->setUrl($endpoint->url);

        $requestHeaderParserResponses = $requestHeaderParser->getResponses();
        foreach ($requestHeaderParserResponses as $requestHeaderParserResponse) {
            $response = new Response;
            $response->status_code = $requestHeaderParserResponse->getStatusCode();
            $response->reason_phrase = $requestHeaderParserResponse->getReasonPhrase();

            $this->request->responses()->save($response);

            foreach ($requestHeaderParserResponse->getHeaders() as $header) {
                $responseHeader = new ResponseHeader;
                $responseHeader->name = $header->getName();
                $responseHeader->value = $header->getValue();

                $response->responseHeaders()->save($responseHeader);
            }
        }
    }
}