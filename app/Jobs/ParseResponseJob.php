<?php

namespace App\Jobs;

use App\Response;
use App\Request as EndpointRequest;
use Psr\Http\Message\ResponseInterface;

class ParseResponseJob extends Job
{
    /**
     * @var EndpointRequest
     */
    private $endpointRequest;

    /**
     * The ResponseInterface that should be parsed.
     *
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param EndpointRequest $endpointRequest
     * @param ResponseInterface $response
     */
    public function __construct(EndpointRequest $endpointRequest, ResponseInterface $response)
    {
        $this->endpointRequest = $endpointRequest;
        $this->response = $response;
    }

    public function handle()
    {
        /** @var Response $response */
        $response = $this->endpointRequest->responses()->create([
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

        dispatch(new ValidateResponseJob($response, $this->endpointRequest->profile));
    }
}
