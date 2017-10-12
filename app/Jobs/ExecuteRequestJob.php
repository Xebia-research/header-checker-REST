<?php

namespace App\Jobs;

use App\Request as EndpointRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class ExecuteRequestJob extends Job
{
    /**
     * The request that should be executed.
     *
     * @var EndpointRequest
     */
    private $request;

    /**
     * ExecuteRequestJob constructor.
     *
     * @param EndpointRequest $request
     */
    public function __construct(EndpointRequest $request)
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
            dispatch(new ParseResponseJob($this->request, $response));
        };

        try {
            $response = $client->request($endpoint->method, $endpoint->url, [
                'http_errors' => false,
                'allow_redirects' => [
                    'max' => 10,
                    'on_redirect' => $onRedirect,
                ],
            ]);

            dispatch(new ParseResponseJob($this->request, $response));
        } catch (RequestException $e) {
            $this->request->error_message = $e->getMessage();
            $this->request->save();
        }
    }
}
