<?php


class RequestTest extends TestCase
{
    public function testIndexAllRequests()
    {
        $requests = \App\Request::all();

        $this->get('requests')
            ->seeJsonEquals($requests->toArray());
    }

    public function testShowSingleRequest()
    {
        /* @var \App\Endpoint $endpoint */
        $endpoint = \App\Endpoint::create();
        $request = $endpoint->requests()->create();

        $this->get('requests/'.$request->id)
            ->seeJsonStructure($request->getVisible());
    }
}
