<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ResponseApiController extends Controller
{
    public function indexAllResponsesByRequest(int $requestId): JsonResponse
    {
        return response()->json([
            'data' => [
                123, 456, 789,
            ],
        ]);
    }

    public function showSingleResponseByRequest(int $requestId, int $responseId): JsonResponse
    {
        return response()->json([
            'request' => $requestId,
            'response' => $responseId,
        ]);
    }
}
