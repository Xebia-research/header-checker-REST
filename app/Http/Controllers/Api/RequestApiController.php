<?php

namespace App\Http\Controllers\Api;

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

    // Function that uses the given url to return the resolved headers
    public function check($url)
    {
        //Retrieve the headers and store in an array
        $header = HeaderParser::getAllHeaders($url);
        return view
        ('master', [
            'url' => $url,
            'header' => $header
        ]);
    }
}

//
// Re-analizeHeaders
// Check
// GetReport