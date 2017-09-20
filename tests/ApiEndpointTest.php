<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApiEndpointTest extends TestCase
{
    /**
     * @dataProvider dpApiEndpoints
     */
    public function testAvailableApiEndpoints($method, $url, $response)
    {
        $this->{$method}($url);

        $this->assertEquals(
            $response, $this->response->getContent()
        );
    }

    public function dpApiEndpoints()
    {
        return [
            ['get', 'requests', 'get.requests'],
            ['get', 'requests/123', 'get.requests.123'],
            ['post', 'requests', 'post.requests'],
            ['get', 'requests/123/responses', 'get.requests.123.responses'],
            ['get', 'requests/123/responses/456', 'get.requests.123.responses.456'],
        ];
    }
}
