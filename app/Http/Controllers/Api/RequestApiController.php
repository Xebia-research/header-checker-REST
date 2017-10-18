<?php

namespace App\Http\Controllers\Api;

use App\Request;
use App\Endpoint;
use Illuminate\Http\Response;
use App\Jobs\ExecuteRequestJob;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as WebRequest;

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
     * @param WebRequest $webRequest
     * @return Response
     */
    public function storeRequest(WebRequest $webRequest): Response
    {
        $this->validate($webRequest, [
            'url' => 'required|url',
            'method' => 'required|in:'.implode(',', \App\Request::getAllowedMethods()),
            'request_headers' => 'array',
            'request_headers.*.name' => 'required',
            'request_headers.*.value' => 'required',
        ]);

        /* @var Endpoint $endpoint */
        $endpoint = \App\Endpoint::firstOrCreate($webRequest->only('url', 'method'));

        /* @var Request $request */
        $request = $endpoint->requests()->create();

        $request->requestHeaders()->createMany($webRequest->get('request_headers', []));

        $this->dispatch(new ExecuteRequestJob($request));

        return response('', 201)->withHeaders([
            'Location' => route('api.requests.show', ['requestId' => $request]),
        ]);
    }
}
