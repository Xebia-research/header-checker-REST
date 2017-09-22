<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Parsers\HeaderParser;

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
        return response()->json([
            'data' => [
                123, 456, 789,
            ],
        ]);
    }

    public function showSingleRequest(int $requestId): JsonResponse
    {
        return response()->json([
            'request' => $requestId,
        ]);
    }

    public function storeRequest(Request $request): JsonResponse
    {
        return response()->json([
            'created' => ($request->input('this') == 'works'),
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