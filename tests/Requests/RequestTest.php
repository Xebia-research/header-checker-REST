<?php

class RequestTest extends ApiTestCase
{
    public function testIndexAllRequests()
    {
        $requests = \App\Request::paginate();

        $this->actingAs($this->application)
            ->get('requests')
            ->seeJsonEquals([
                'data' => $requests->toArray(),
            ]);
    }

    public function testShowSingleRequest()
    {
        /* @var \App\Endpoint $endpoint */
        $endpoint = \App\Endpoint::create();
        $request = $endpoint->requests()->create();

        $this->actingAs($this->application)
            ->get('requests/'.$request->id)
            ->seeJsonStructure([
                'data' => $request->toArray(),
            ]);
    }
}
