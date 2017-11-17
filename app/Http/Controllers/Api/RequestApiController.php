<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\ExecuteRequestJob;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Spatie\ArrayToXml\ArrayToXml;

class RequestApiController extends Controller
{

    private const FORMAT_XML = "xml";
    private const FORMAT_JSON = "json";
    private const FORMAT_HTML = "html";

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
     * @param string $format
     * @return Response
     */
    public function showSingleRequest(int $requestId, string $format = null)
    {
        $request = \App\Request::findOrFail($requestId);
        return $this->showOutput($request, $format);
    }

    /**
     * Method to convert collection into desired format
     * @param Collection $collection
     * @param string $format
     * @return Response
     */
    public function showOutput($resource, string $format = null)
    {
        $format = strtolower($format);

        switch ($format){
            case static::FORMAT_JSON:
                return response()->json($resource);
            case static::FORMAT_XML:
                return ArrayToXml::convert($resource->toArray());
            case static::FORMAT_HTML:
                //TODO: return HTML response
                return view('html_response', ['resource' => $resource]);
            default:
                return response()->json($resource);
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
            'method' => 'required|in:' . implode(',', \App\Request::getAllowedMethods()),
        ]);

        $endpoint = \App\Endpoint::firstOrCreate($request->only('url', 'method'));
        $endpointRequest = $endpoint->requests()->create();

        $this->dispatch(new ExecuteRequestJob($endpointRequest));

        return response('', 201)->withHeaders([
            'Location' => route('api.requests.show', ['requestId' => $endpointRequest]),
        ]);
    }
}
