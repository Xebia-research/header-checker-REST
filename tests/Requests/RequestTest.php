<?php

use App\Endpoint;
use App\Request as EndpointRequest;

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
        /* @var \App\Endpoint $endpoint */
        $endpoint = Endpoint::create([
            'url' => 'https://www.google.com/',
            'method' => EndpointRequest::getAllowedMethods()[0],
        ]);
        $request = $endpoint->requests()->create([
            'profile_id' => $this->profile->id,
        ]);

        $this->actingAs($this->application)
            ->get('requests/'.$request->id)
            ->seeJsonStructure($request->getVisible());
    }
}
