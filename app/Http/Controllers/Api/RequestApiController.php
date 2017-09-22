<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Parsers\HeaderParser;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RequestApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function indexAllRequests(): JsonResponse
    {
        $requests = \App\Request::all();

        return response()->json($requests);
    }

    public function showSingleRequest(int $requestId): JsonResponse
    {
        $request = \App\Request::findOrFail($requestId);

        return response()->json($request);
    }

    public function storeRequest(Request $request): Response
    {
        $this->validate($request, [
            'url' => 'required|url',
            'method' => 'required|in:GET,HEAD,POST,PUT,DELETE,CONNECT,OPTIONS,TRACE,PATCH',
        ]);

        $endpoint = \App\Endpoint::firstOrCreate($request->only('url', 'method'));
        $endpointRequest = $endpoint->requests()->create();

        return response('', 201)->withHeaders([
            'Location' => route('api.requests.show', ['requestId' => $endpointRequest]),
        ]);
    }

    // Function that uses the given url to return the resolved headers
    public function check($url)
    {
        //Retrieve the headers and store in an array
        $header = HeaderParser::getAllHeaders($url);

        return view('master', [
            'url'    => $url,
            'header' => $header,
        ]);
    }
}
