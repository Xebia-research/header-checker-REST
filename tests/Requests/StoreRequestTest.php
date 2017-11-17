<?php

class StoreRequestTest extends ApiTestCase
{
    public function testShouldRespondUnprocessableEntityWhenUrlAndMethodAreNotPresent()
    {
        $response = $this->actingAs($this->application)->post('requests');
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsNotPresent()
    {
        $this->actingAs($this->application)
            ->post('requests', [
            'method' => \App\Request::getAllowedMethods()[0],
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsNotPresent()
    {
        $response = $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlAndMethodAreEmpty()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => '',
            'method' => '',
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlAndMethodIsEmpty()
    {
        $response = $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => '',
        ]);
        $response->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsEmpty()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => '',
            'method' => \App\Request::getAllowedMethods()[0],
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsEmpty()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => '',
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenUrlIsInvalid()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'httpa://www.google.com2/',
            'method' => \App\Request::getAllowedMethods()[0],
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenMethodIsInvalid()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GOT',
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenRequestHeadersIsEmptyIsInvalid()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
            'request_headers' => 'loremipsum',
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenRequestHeaderNameIsEmpty()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
            'request_headers' => [
                [
                    'name' => '',
                    'value' => 'Basic dXNlcm5hbWU6cGFzc3dvcmQ=',
                ],
            ],
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondUnprocessableEntityWhenRequestHeaderValueIsEmpty()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
            'request_headers' => [
                [
                    'name' => 'Authorization',
                    'value' => '',
                ],
            ],
        ])->assertResponseStatus(422);
    }

    public function testShouldRespondOkWhenUrlMethodAndRequestHeaderAreValid()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
            'request_headers' => [
                [
                    'name' => 'Authorization',
                    'value' => 'Basic dXNlcm5hbWU6cGFzc3dvcmQ=',
                ],
            ],
        ])->assertResponseStatus(201);
    }

    public function testShouldRespondOkWhenUrlAndMethodAreValid()
    {
        foreach (\App\Request::getAllowedMethods() as $method) {
            $this->actingAs($this->application)->post('requests', [
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

        $this->actingAs($this->application)->post('requests', $parameters);
        $this->seeInDatabase('endpoints', $parameters);
    }

    public function testShouldExecuteExecuteRequestJob()
    {
        $this->expectsJobs(\App\Jobs\ExecuteRequestJob::class);

        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
        ])->assertResponseStatus(201);
    }

    public function testShouldRespondWithLocation()
    {
        $this->actingAs($this->application)->post('requests', [
            'url' => 'https://www.google.com/',
            'method' => 'GET',
        ])->seeHeader('Location');
    }
}
