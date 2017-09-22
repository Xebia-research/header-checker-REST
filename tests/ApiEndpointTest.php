<?php


class ApiEndpointTest extends TestCase
{
    public function testShowWelcomeMessage()
    {
        $this->get('/')
            ->seeJsonEquals([
                'hello' => 'world',
            ]);
    }

    public function testIndexAllRequests()
    {
        $this->get('requests')
            ->seeJsonEquals([
                'data' => [
                    123, 456, 789,
                ],
            ]);
    }

    public function testShowSingleRequest()
    {
        $requestId = rand();

        $this->get("requests/{$requestId}")
            ->seeJsonEquals([
                'request' => $requestId,
            ]);
    }

    public function testStoreRequest()
    {
        $this->post('requests', [
                'this' => 'works',
            ])->seeJsonEquals([
                'created' => true,
            ]);
    }

    public function testFailedCreatingStoreRequest()
    {
        $this->post('requests', [
                'this' => 'burps',
            ])->seeJsonEquals([
                'created' => false,
            ]);
    }

    public function testIndexAllResponsesByRequest()
    {
        $requestId = rand();

        $this->get("requests/{$requestId}/responses")
            ->seeJsonEquals([
                'data' => [
                    123, 456, 789,
                ],
            ]);
    }

    public function testShowSingleResponseByRequest()
    {
        $requestId = rand();
        $responseId = rand();

        $this->get("requests/{$requestId}/responses/{$responseId}")
            ->seeJsonEquals([
                'request' => $requestId,
                'response' => $responseId,
            ]);
    }
}
