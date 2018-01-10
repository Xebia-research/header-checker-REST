<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Psr\Http\Message\UriInterface;
use App\Request as EndpointRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class ExecuteRequestJob extends Job
{
    /**
     * The request that should be executed.
     *
     * @var EndpointRequest
     */
    private $endpointRequest;

    /**
     * ExecuteRequestJob constructor.
     *
     * @param EndpointRequest $endpointRequest
     */
    public function __construct(EndpointRequest $endpointRequest)
    {
        $this->endpointRequest = $endpointRequest;
    }

    /**
     * Create RequestHeaderParser instance and set method and url.
     * Get responses from RequestHeaderParser and save them in the database.
     *
     * @param Client $client
     */
    public function handle(Client $client)
    {
        $endpoint = $this->endpointRequest->endpoint;

        $onRedirect = function (RequestInterface $request, ResponseInterface $response, UriInterface $uri) {
            dispatch(new ParseResponseJob($this->endpointRequest, $response));
        };

        try {
            $response = $client->request($endpoint->method, $endpoint->url, [
                'http_errors' => false,
                'allow_redirects' => [
                    'max' => 10,
                    'on_redirect' => $onRedirect,
                ],
                'headers' => $this->getHeaders(),
                'form_params' => $this->endpointRequest->requestParameters->pluck('value', 'name')->toArray(),
            ]);

            dispatch(new ParseResponseJob($this->endpointRequest, $response));
        } catch (RequestException $e) {
            $this->endpointRequest->error_message = $e->getMessage();
            $this->endpointRequest->save();
        }
    }

    /**
     * @return array
     */
    private function getHeaders(): array
    {
        $headers = $this->endpointRequest->requestHeaders->pluck('value', 'name');

        if (! $headers->has('User-Agent') && $this->endpointRequest->profile->user_agent) {
            $headers->put('User-Agent', $this->endpointRequest->profile->user_agent);
        }

        return $headers->toArray();
    }
}
