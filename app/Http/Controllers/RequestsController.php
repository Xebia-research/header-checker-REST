<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\View\View;

class RequestsController extends Controller
{
    /**
     * Get one request from the database.
     *
     * @param int $requestId
     * @return View
     */
    public function show(int $requestId): View
    {
        $request = Request::with([
            'endpoint',
            'profile',
            'requestHeaders',
            'requestParameters',
            'responses',
            'responses.responseHeaders',
        ])->findOrFail($requestId);

        return view('requests.show', compact('request'));
    }
}