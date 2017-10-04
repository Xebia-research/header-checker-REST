<?php

class StoreRequestTest extends TestCase
{
    public function testShouldRespondUnprocessableEntityWhenUrlAndMethodAreNotPresent()
    {
        $response = $this->post('requests');
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsNotPresent()
    {
        $this->post('requests', [
            'method' => \App\Request::getAllowedMethods()[0],
        ])->assertResponseStatus(422);
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
        $this->post('requests', [
            'url' => '',
            'method' => '',
        ])->assertResponseStatus(422);
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
        $this->post('requests', [
            'url' => '',
            'method' => \App\Request::getAllowedMethods()[0],
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsEmpty()
    {
        $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => '',
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsInvalid()
    {
        $this->post('requests', [
            'url' => 'httpa://www.google.com2/',
            'method' => \App\Request::getAllowedMethods()[0],
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsInvalid()
    {
        $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GOT',
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondOkWhenUrlAndMethodAreValid()
    {
        foreach (\App\Request::getAllowedMethods() as $method) {
            $this->post('requests', [
                'url' => 'https://www.google.com/',
                'method' => $method,
            ])->assertResponseStatus(201);
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
        ])->assertResponseStatus(201);
    }

    public function testShouldRespondWithLocation()
    {
        $this->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
        ])->seeHeader('Location');
    }
}
