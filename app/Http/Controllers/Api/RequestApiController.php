<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Endpoint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\ExecuteRequestJob;
use Illuminate\Http\JsonResponse;
use App\Request as EndpointRequest;
use App\Http\Controllers\Controller;

class RequestApiController extends Controller
{
    /**
     * Find all requests in the database.
     *
     * @return JsonResponse
     */
    public function indexAllRequests(): JsonResponse
    {
        $requests = \App\Request::all();

        return response()->json($requests);
    }

    /**
     * Find request in the database.
     * Throwed 404 when request is not found.
     *
     * @param int $requestId
     * @return JsonResponse
     */
    public function showSingleRequest(int $requestId): JsonResponse
    {
        $request = \App\Request::findOrFail($requestId);

        return response()->json($request);
    }

    /**
     * Validate if parameters are valid.
     * Find or create endpoint based on url and method.
     * Create a new request for the endpoint.
     * Dispatch ExecuteRequestJob.
     *
     * @param Request $request
     * @return Response
     */
    public function storeRequest(Request $request): Response
    {
        $this->validateStoreRequest($request);

        /* @var Endpoint $endpoint */
        $endpoint = Endpoint::firstOrCreate($request->only('url', 'method'));
        $endpointRequest = $this->createEndpointRequest($request, $endpoint);

        $this->dispatch(new ExecuteRequestJob($endpointRequest));

        return response('', 201)->withHeaders([
            'Location' => route('api.requests.show', ['requestId' => $endpointRequest]),
        ]);
    }

    /**
     * Validate storeRequest.
     *
     * @param Request $request
     */
    private function validateStoreRequest(Request $request)
    {
        $this->validate($request, [
            'url' => [
                'required',
                'url',
            ],
            'method' => [
                'required',
                'in:'.implode(',', \App\Request::getAllowedMethods()),
            ],
            'profile' => [
                'required',
                'exists:profiles,identifier',
            ],
            'request_headers' => 'array',
            'request_headers.*.name' => [
                'required',
                'string',
                'max:255',
            ],
            'request_headers.*.value' => [
                'required',
                'string',
                'max:16777215',
            ],
        ]);
    }

    /**
     * Create EndpointRequest for Request and Endpoint.
     *
     * @param Request $request
     * @param Endpoint $endpoint
     * @return EndpointRequest
     */
    private function createEndpointRequest(Request $request, Endpoint $endpoint): EndpointRequest
    {
        $profile = Profile::whereIdentifier($request->get('profile'))
            ->first();

        /* @var \App\Request $endpointRequest */
        $endpointRequest = $endpoint->requests()->create([
            'profile_id' => $profile->id,
        ]);
        $endpointRequest->requestHeaders()->createMany($request->get('request_headers', []));

        return $endpointRequest;
    }
}
