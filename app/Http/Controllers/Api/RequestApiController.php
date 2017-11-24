<?php

namespace App\Http\Controllers\Api;

use App\Endpoint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\ExecuteRequestJob;
use Illuminate\Http\JsonResponse;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class RequestApiController extends Controller
{
    private const FORMAT_XML = 'xml';
    private const FORMAT_JSON = 'json';
    private const FORMAT_HTML = 'html';

    /**
     * Find all requests in the database.
     *
     * @return JsonResponse
     */
    public function indexAllRequests(string $format = null)
    {
        $requests = \App\Request::all();
        $response = $this->showOutput($requests, $format);

        return $response;
    }

    /**
     * Find request in the database.
     * Throwed 404 when request is not found.
     *
     * @param int $requestId
     * @param string $format
     * @return Response
     */
    public function showSingleRequest(int $requestId, string $format = null)
    {
        $request = \App\Request::findOrFail($requestId);

        return $this->showOutput($request, $format);
    }

    /**
     * Method to convert collection into desired format.
     * @param Collection $resource
     * @param string $format
     * @return Response
     */
    public function showOutput($resource, string $format = null)
    {
        $format = strtolower($format);
        $array = [];
        $isCollection = false;
        $requestName = 'request';

        if ($resource instanceof \Illuminate\Database\Eloquent\Collection) {
            $array = [
                'request' => $resource->toArray(),
            ];
            $isCollection = true;
            $requestName = 'collection';
        } else {
            // Single model
            $array = $resource->toArray();
        }

        switch ($format) {
            case static::FORMAT_JSON:
                return response()->json($array);
            case static::FORMAT_XML:
                return ArrayToXml::convert($array, $requestName);
            case static::FORMAT_HTML:
                    return view('html_request', ['resource' => $array, 'isCollection' => $isCollection]);
            default:
                return response()->json($array);
        }
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
        $this->validate($request, [
            'url' => 'required|url',
            'method' => 'required|in:'.implode(',', \App\Request::getAllowedMethods()),
            'request_headers' => 'array',
            'request_headers.*.name' => 'required|string|max:255',
            'request_headers.*.value' => 'required|string|max:16777215',
        ]);

        /* @var Endpoint $endpoint */
        $endpoint = \App\Endpoint::firstOrCreate($request->only('url', 'method'));

        /* @var \App\Request $endpointRequest */
        $endpointRequest = $endpoint->requests()->create();

        $endpointRequest->requestHeaders()->createMany($request->get('request_headers', []));

        $this->dispatch(new ExecuteRequestJob($endpointRequest));

        return response('', 201)->withHeaders([
            'Location' => route('api.requests.show', ['requestId' => $endpointRequest]),
        ]);
    }
}
