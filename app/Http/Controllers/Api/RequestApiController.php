<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Endpoint;
use App\Request;
use App\Jobs\ExecuteRequestJob;

class RequestApiController extends Controller
{
    /**
     * Get all requests from the database.
     *
     * @return \App\Http\Resources\Json\RequestCollection|\App\Http\Resources\Xml\RequestCollection
     */
    public function index()
    {
        $requests = Request::paginate();

        return $this->response->resourceCollectionResponse($requests);
    }

    /**
     * Get one request from the database.
     *
     * @param int $requestId
     * @return \App\Http\Resources\Json\Request|\App\Http\Resources\Xml\Request
     */
    public function show(int $requestId)
    {
        $request = Request::with([
            'endpoint',
            'profile',
            'requestHeaders',
            'responses',
            'responses.responseHeaders',
        ])->findOrFail($requestId);

        return $this->response->singleResourceResponse($request);
    }

    /**
     * Store a request in the database and enqueue the ExecuteRequestJob.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Json\Request|\App\Http\Resources\Xml\Request
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'url' => [
                'required',
                'url',
            ],
            'method' => [
                'required',
                'in:' . implode(',', \App\Request::getAllowedMethods()),
            ],
            'profile' => [
                'required',
                'exists:profiles,identifier',
            ],
            'request_headers' => 'array',
            'request_headers.*.name' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
            ],
            'request_headers.*.value' => [
                'required',
                'string',
                'max:16777215',
            ],
        ]);

        $request = $this->createRequest($request->all());

        return $this->response->singleResourceResponse($request);
    }

    /**
     * Store a batch requests in the database and enqueue the ExecuteRequestJob's.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Json\RequestCollection|\App\Http\Resources\Xml\RequestCollection
     */
    public function storeBatch(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'requests' => [
                'required',
                'array',
            ],
            'requests.*.url' => [
                'required',
                'url',
            ],
            'requests.*.method' => [
                'required',
                'in:' . implode(',', \App\Request::getAllowedMethods()),
            ],
            'requests.*.profile' => [
                'required',
                'exists:profiles,identifier',
            ],
            'requests.*.request_headers' => 'array',
            'requests.*.request_headers.*.name' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
            ],
            'requests.*.request_headers.*.value' => [
                'required',
                'string',
                'max:16777215',
            ],
        ]);

        $requests = collect();
        foreach ($request->get('requests') as $parameters) {
            $request = $this->createRequest($parameters);
            $requests->push($request);
        }

        return $this->response->resourceCollectionResponse($requests);
    }

    /**
     * Create Request for array of parameters.
     *
     * @param array $parameters
     * @return Request
     */
    private function createRequest(array $parameters): Request
    {
        /* @var Endpoint $endpoint */
        $endpoint = Endpoint::firstOrCreate(array_only($parameters, ['url', 'method']));

        $profile = Profile::whereIdentifier(data_get($parameters, 'profile'))
            ->first();

        /* @var \App\Request $request */
        $request = $endpoint->requests()->create([
            'profile_id' => $profile->id,
        ]);
        $request->requestHeaders()->createMany(data_get($parameters, 'request_headers', []));

        $this->dispatch(new ExecuteRequestJob($request));

        return $request;
    }
}
