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
        /* @var \App\Request $request */
        $request = \App\Request::first();

        $this->get('requests/'.$request->id)
            ->seeJsonEquals($request->toArray());
    }
}
