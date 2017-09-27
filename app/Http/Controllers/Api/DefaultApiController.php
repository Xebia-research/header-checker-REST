<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DefaultApiController extends Controller
{
    /**
     * Response welcome message.
     *
     * @return JsonResponse
     */
    public function showWelcomeMessage(): JsonResponse
    {
        return response()->json([
            'hello' => 'world',
        ]);
    }
}
