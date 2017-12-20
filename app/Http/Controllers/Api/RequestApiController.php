<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Endpoint;
use App\Request;
use App\Jobs\ExecuteRequestJob;
use Illuminate\Support\Collection;

class RequestApiController extends Controller
{
    /**
     * Find all requests in the database.
     *
     * @param null|string $format
     * @return \App\Http\Resources\Html\RequestCollection|\App\Http\Resources\Json\RequestCollection|\App\Http\Resources\Xml\RequestCollection
     */
    public function indexAllRequests(?string $format = null)
    {
        $requests = Request::paginate();

        return $this->resourceCollectionResponse($requests, $format);
    }

    /**
     * Find request in the database.
     * Throw 404 when request is not found.
     *
     * @param int $requestId
     * @param null|string $format
     * @return \App\Http\Resources\Html\Request|\App\Http\Resources\Json\Request|\App\Http\Resources\Xml\Request
     */
    public function showSingleRequest(int $requestId, ?string $format = null)
    {
        $request = Request::with([
            'endpoint',
            'profile',
            'requestHeaders',
            'responses',
            'responses.responseHeaders',
        ])->findOrFail($requestId);

        if ($format == static::FORMAT_HTML) {
            return view('requests.show', compact('request'));
        } else {
            return $this->singleResourceResponse($request, $format);
        }
    }

    /**
     * Store request and enqueue ExecuteRequestJob.
     *
     * @param \Illuminate\Http\Request $request
     * @param null|string $format
     * @return \App\Http\Resources\Html\Request|\App\Http\Resources\Json\Request|\App\Http\Resources\Xml\Request
     */
    public function store(\Illuminate\Http\Request $request, ?string $format = null)
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

        if ($format == static::FORMAT_HTML) {
            return view('requests.show', compact('request'));
        } else {
            return $this->singleResourceResponse($request, $format);
        }
    }

    /**
     * Store requests and enqueue ExecuteRequestJob in batch.
     *
     * @param \Illuminate\Http\Request $request
     * @param null|string $format
     * @return \App\Http\Resources\Html\RequestCollection|\App\Http\Resources\Json\RequestCollection|\App\Http\Resources\Xml\RequestCollection
     */
    public function storeBatch(\Illuminate\Http\Request $request, ?string $format = null)
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
                'in:'.implode(',', \App\Request::getAllowedMethods()),
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

        return $this->resourceCollectionResponse($requests, $format);
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
