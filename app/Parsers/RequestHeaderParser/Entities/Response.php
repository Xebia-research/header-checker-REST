<?php

namespace App\Parsers\RequestHeaderParser\Entities;

class Response
{
    /**
     * The response HTTP status code.
     *
     * @var int
     */
    private $statusCode;

    /**
     * The response reason phrase.
     *
     * @var string
     */
    private $reasonPhrase;

    /**
     * The response headers.
     *
     * @var Header[]
     */
    private $headers;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->headers = [];
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    /**
     * @param string $reasonPhrase
     */
    public function setReasonPhrase(string $reasonPhrase)
    {
        $this->reasonPhrase = $reasonPhrase;
    }

    /**
     * @return Header[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param Header $header
     */
    public function addHeader(Header $header)
    {
        array_push($this->headers, $header);
    }
}
