<?php

namespace App\Parsers\RequestHeaderParser;

use App\Parsers\RequestHeaderParser\Entities\Header;
use App\Parsers\RequestHeaderParser\Entities\Response;
use App\Parsers\RequestHeaderParser\Exceptions\FailedFetchingResponseHeadersException;
use App\Parsers\RequestHeaderParser\Exceptions\InvalidEndpointMethodException;
use App\Parsers\RequestHeaderParser\Exceptions\InvalidEndpointUrlException;

class RequestHeaderParser
{
    /**
     * Allowed methods.
     *
     * @var array
     */
    private static $allowedMethods = [
        'GET',
        'HEAD',
        'POST',
        'PUT',
        'DELETE',
        'CONNECT',
        'OPTIONS',
        'TRACE',
        'PATCH',
    ];

    /**
     * Method that should be used to execute the HTTP request.
     *
     * @var string
     */
    private $method;

    /**
     * Url that should be used to execute the HTTP request.
     *
     * @var string
     */
    private $url;

    /**
     * The response headers from the HTTP request.
     *
     * @var array
     */
    private $headers;

    /**
     * @param $method
     * @throws InvalidEndpointMethodException
     */
    public function setMethod($method)
    {
        if (! in_array($method, static::$allowedMethods)) {
            throw new InvalidEndpointMethodException();
        }

        $this->method = $method;
    }

    /**
     * @param $url
     * @throws InvalidEndpointUrlException
     */
    public function setUrl($url)
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidEndpointUrlException();
        }

        $this->url = $url;
    }

    /**
     * Execute request and parse responses with headers.
     *
     * @return Response[]
     */
    public function getResponses(): array
    {
        $this->execute();

        /* @var Response[] $responses */
        $responses = [];
        foreach ($this->headers as $headerName => $headerValue) {
            if (! is_int($headerName)) {
                continue;
            }

            $response = new Response;
            $response->setStatusCode($this->getStatusCode($headerValue));
            $response->setReasonPhrase($headerValue);

            array_push($responses, $response);
        }

        $currentResponseIndex = 0;
        foreach ($this->headers as $headerName => $headerValue) {
            if (is_int($headerName)) {
                $currentResponseIndex = $headerName;

                continue;
            }

            if (is_array($headerValue)) {
                foreach ($headerValue as $responseIndex => $value) {
                    $header = new Header;
                    $header->setName($headerName);
                    $header->setValue($value);

                    $responses[$responseIndex]->addHeader($header);
                }
            } else {
                $header = new Header;
                $header->setName($headerName);
                $header->setValue($headerValue);

                $responses[$currentResponseIndex]->addHeader($header);
            }
        }

        return $responses;
    }

    /**
     * Get status code by HTTP reason phrase.
     *
     * @param $reasonPhrase
     * @return int
     */
    private function getStatusCode($reasonPhrase): int
    {
        preg_match('/[1-5][0-9]{2}/', $reasonPhrase, $matches);

        return $matches[0];
    }

    /**
     * Execute HTTP request to url with request method.
     *
     * @throws FailedFetchingResponseHeadersException
     */
    private function execute()
    {
        if (! $this->method) {
            throw new InvalidEndpointUrlException();
        }
        if (! $this->url) {
            throw new InvalidEndpointMethodException();
        }

        try {
            stream_context_set_default([
                'http' => [
                    'method' => $this->method,
                ],
            ]);

            $this->headers = get_headers($this->url, 1);
        } catch (\Exception $exception) {
            throw new FailedFetchingResponseHeadersException($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public static function getAllowedMethods(): array
    {
        return self::$allowedMethods;
    }

    /**
     * @param string $glue
     * @return string
     */
    public static function getAllowedMethodsImploded(string $glue = ','): string
    {
        return implode($glue, static::$allowedMethods);
    }
}
