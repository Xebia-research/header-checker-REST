<?php

use App\Parsers\RequestHeaderParser;

class StoreRequestTest extends TestCase
{
    public function testShouldRespondUnprocessableEntityWhenUrlAndMethodAreNotPresent()
    {
        $response = $this->post('requests');
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsNotPresent()
    {
        $response = $this->post('requests', [
            'method' => RequestHeaderParser::$allowedMethods[0],
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsNotPresent()
    {
        $response = $this->post('requests', [
            'url' => 'https://www.google.com/',
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlAndMethodAreEmpty()
    {
        $response = $this->post('requests', [
            'url' => '',
            'method' => '',
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlAndMethodIsEmpty()
    {
        $response = $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => '',
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsEmpty()
    {
        $response = $this->post('requests', [
            'url' => '',
            'method' => RequestHeaderParser::$allowedMethods[0],
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsEmpty()
    {
        $response = $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => '',
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsInvalid()
    {
        $response = $this->post('requests', [
            'url' => 'httpa://www.google.com2/',
            'method' => RequestHeaderParser::$allowedMethods[0],
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsInvalid()
    {
        $response = $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GOT',
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondOkWhenUrlAndMethodAreValid()
    {
        foreach (RequestHeaderParser::$allowedMethods as $method) {
            $response = $this->post('requests', [
                'url' => 'https://www.google.com/',
                'method' => $method,
            ]);
            $response->assertResponseStatus(201);
        }
    }

    public function testShouldCreateEndpoint()
    {
        $parameters = [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
        ];

        $this->post('requests', $parameters);
        $this->seeInDatabase('endpoints', $parameters);
    }

    public function testShouldExecuteExecuteRequestJob()
    {
        $this->expectsJobs(\App\Jobs\ExecuteRequestJob::class);

        $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
        ]);
    }

    public function testShouldRespondWithLocation()
    {
        $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
        ])->seeHeader('Location');
    }
}