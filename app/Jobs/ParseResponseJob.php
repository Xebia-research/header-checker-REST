<?php

namespace App\Jobs;

use App\Request as EndpointRequest;
use App\Response;
use Psr\Http\Message\ResponseInterface;

class ParseResponseJob extends Job
{
    /**
     * @var EndpointRequest
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param EndpointRequest $request
     * @param ResponseInterface $response
     */
    public function __construct(EndpointRequest $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function handle()
    {
        /** @var Response $response */
        $response = $this->request->responses()->create([
            'status_code' => $this->response->getStatusCode(),
            'reason_phrase' => $this->response->getReasonPhrase(),
        ]);

        $responseHeaders = [];

        foreach ($this->response->getHeaders() as $headerName => $headerValue) {
            if (is_array($headerValue)) {
                foreach ($headerValue as $valueString) {
                    $responseHeaders[] = [
                        'name' => $headerName,
                        'value' => $valueString,
                    ];
                }
            } else {
                $responseHeaders[] = [
                    'name' => $headerName,
                    'value' => $headerValue,
                ];
            }
        }

        $response->responseHeaders()->createMany($responseHeaders);
    }
}
