<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequestApiController extends Controller
{
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
}
