<?php

use App\Request as EndpointRequest;
use App\Endpoint;

class RequestTest extends ApiTestCase
{
    public function testIndexAllRequests()
    {
        $requests = EndpointRequest::all();

        $this->actingAs($this->application)
            ->get('requests')
            ->seeJsonEquals($requests->toArray());
    }

    public function testShowSingleRequest()
    {
        /* @var Endpoint $endpoint */
        $endpoint = Endpoint::create();
        $endpointRequest = $endpoint->requests()->create([
            'profile_id' => $this->profile->id,
        ]);

        $this->actingAs($this->application)
            ->get('requests/'.$endpointRequest->id)
            ->seeJsonStructure($endpointRequest->getVisible());
    }
}
