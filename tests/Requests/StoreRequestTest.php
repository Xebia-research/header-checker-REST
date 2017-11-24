<?php

use App\Request as EndpointRequest;

class StoreRequestTest extends ApiTestCase
{
    /**
     * Valid request parameters for a Request.
     *
     * @var array
     */
    private $validRequestParameters;

    private $validRequestHeadersParameters = [
        [
            'name' => 'Authorization',
            'value' => 'Basic dXNlcm5hbWU6cGFzc3dvcmQ=',
        ],
    ];

    /**
     * Setup StoreRequestTest
     */
    public function setUp()
    {
        parent::setUp();

        $this->validRequestParameters = [
            'url' => 'https://www.google.com/',
            'method' => EndpointRequest::getAllowedMethods()[0],
            'profile' => $this->profile->identifier,
        ];
    }

    public function testShouldRespond422WhenRequestParametersAreNotPresent()
    {
        $response = $this->actingAs($this->application)->post('requests');
        $response->assertResponseStatus(422);
    }

    public function testShouldRespond422WhenRequiredParametersAreNotPresent()
    {
        foreach ($this->validRequestParameters as $name => $value) {
            $this->actingAs($this->application)
                ->post(
                    'requests',
                    array_except($this->validRequestParameters, [$name])
                )->assertResponseStatus(422);
        }
    }

    public function testShouldRespond422WhenRequiredParametersAreEmpty()
    {
        foreach ($this->validRequestParameters as $name => $value) {
            $requestParameters = $this->validRequestParameters;
            $requestParameters[$name] = '';

            $this->actingAs($this->application)
                ->post('requests', $requestParameters)
                ->assertResponseStatus(422);
        }
    }

    public function testShouldRespond422WhenRequiredParametersAreInvalid()
    {
        foreach ($this->validRequestParameters as $name => $value) {
            $requestParameters = $this->validRequestParameters;
            $requestParameters[$name] = str_random();

            $this->actingAs($this->application)
                ->post('requests', $requestParameters)
                ->assertResponseStatus(422);
        }
    }

    public function testShouldRespond201WhenRequestIsValid()
    {
        $requestParameters = $this->validRequestParameters;

        foreach (\App\Request::getAllowedMethods() as $method) {
            $requestParameters['method'] = $method;

            $this->actingAs($this->application)
                ->post('requests', $requestParameters)
                ->assertResponseStatus(201);
        }
    }

    public function testShouldRespond422WhenRequestHeadersAreInvalid()
    {
        $requestParameters = $this->validRequestParameters;
        $requestParameters['request_headers'] = str_random();

        $this->actingAs($this->application)
            ->post('requests', $requestParameters)
            ->assertResponseStatus(422);
    }

    public function testShouldRespond422WhenRequestHeaderNameIsEmpty()
    {
        $requestHeadersParameters = $this->validRequestHeadersParameters;
        $requestHeadersParameters[0]['name'] = '';

        $requestParameters = $this->validRequestParameters;
        $requestParameters['request_headers'] = $requestHeadersParameters;

        $this->actingAs($this->application)
            ->post('requests', $requestParameters)
            ->assertResponseStatus(422);
    }

    public function testShouldRespond422WhenRequestHeaderValueIsEmpty()
    {
        $requestHeadersParameters = $this->validRequestHeadersParameters;
        $requestHeadersParameters[0]['value'] = '';

        $requestParameters = $this->validRequestParameters;
        $requestParameters['request_headers'] = $requestHeadersParameters;

        $this->actingAs($this->application)
            ->post('requests', $requestParameters)
            ->assertResponseStatus(422);
    }

    public function testShouldResponse201WhenRequestHeadersAreValid()
    {
        $requestParameters = $this->validRequestParameters;
        $requestParameters['request_headers'] = $this->validRequestHeadersParameters;

        $this->actingAs($this->application)
            ->post('requests', $requestParameters)
            ->assertResponseStatus(201);
    }

    public function testShouldCreateEndpoint()
    {
        $this->actingAs($this->application)
            ->post('requests', $this->validRequestParameters);
        $this->seeInDatabase('endpoints', array_only($this->validRequestParameters, ['url', 'method']));
    }

    public function testShouldExecuteExecuteRequestJob()
    {
        $this->expectsJobs(\App\Jobs\ExecuteRequestJob::class);

        $this->actingAs($this->application)
            ->post('requests', $this->validRequestParameters)
            ->assertResponseStatus(201);
    }

    public function testShouldRespondWithLocation()
    {
        $this->actingAs($this->application)
            ->post('requests', $this->validRequestParameters)
            ->seeHeader('Location');
    }
}
