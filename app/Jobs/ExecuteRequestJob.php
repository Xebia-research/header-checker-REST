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

        $application_profile = $this->request->application_profile ?? 'api'; // TODO: Default application profiles?

        $onRedirect = function (RequestInterface $request, ResponseInterface $response, UriInterface $uri) use ($application_profile) {
            dispatch(
                (new ParseResponseJob($this->request, $response))->chain([
                    new AnalyzeResponseHeaderJob($application_profile, $this->request->responseHeaders),
                ])
            );
        };

        try {
            $response = $client->request($endpoint->method, $endpoint->url, [
                'http_errors' => false,
                'allow_redirects' => [
                    'max' => 10,
                    'on_redirect' => $onRedirect,
                ],
            ]);

            dispatch(
                (new ParseResponseJob($this->request, $response))->chain([
                    new AnalyzeResponseHeaderJob($application_profile, $this->request->responseHeaders),
                ])
            );
        } catch (RequestException $e) {
            $this->request->error_message = $e->getMessage();
            $this->request->save();
        }
    }
}
