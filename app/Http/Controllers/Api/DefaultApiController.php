<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DefaultApiController extends Controller
{
    public function showWelcomeMessage(): JsonResponse
    {
        return response()->json([
            'hello' => 'world',
        ]);
    }
}
