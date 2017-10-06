<?php

namespace App\Jobs;

use App\Response;
use GuzzleHttp\Client;
use App\ResponseHeader;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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

    /**
     * Create RequestHeaderParser instance and set method and url.
     * Get responses from RequestHeaderParser and save them in the database.
     *
     * @param Client $client
     */
    public function handle(Client $client)
    {
        $endpoint = $this->request->endpoint;

        $onRedirect = function (RequestInterface $request, ResponseInterface $response, UriInterface $uri) {
            $this->handleResponse($response);
        };

        $response = $client->request($endpoint->method, $endpoint->url, [
            'http_errors' => false,
            'allow_redirects' => [
                'on_redirect' => $onRedirect,
            ],
        ]);
        $this->handleResponse($response);
    }

    private function handleResponse(ResponseInterface $guzzleResponse)
    {
        $response = new Response;
        $response->status_code = $guzzleResponse->getStatusCode();
        $response->reason_phrase = $guzzleResponse->getReasonPhrase();

        $this->request->responses()->save($response);

        foreach ($guzzleResponse->getHeaders() as $key=>$value) {
            if (is_array($value)) {
                foreach ($value as $valueString) {
                    $responseHeader = new ResponseHeader;
                    $responseHeader->name = $key;
                    $responseHeader->value = $valueString;

                    $response->responseHeaders()->save($responseHeader);
                }
            } else {
                $responseHeader = new ResponseHeader;
                $responseHeader->name = $key;
                $responseHeader->value = $value;

                $response->responseHeaders()->save($responseHeader);
            }
        }
    }
}
