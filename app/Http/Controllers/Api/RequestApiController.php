<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

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
        $header = $this->getAllHeaders($url);
        return view
        ('master', [
            'url' => $url,
            'header' => $header
        ]);
    }

    // Function that retrieves the headers and returns them in form of an array
    public function getAllHeaders($url)
    {
        // TODO: Make it possible to pass HyperTextTransferProtocol in url
        // Include https in the url as it can currently not be included in the url field of the browser
        // For now it is https by default
        $url = 'https://' . $url;
        // Retrieve headers and store in array
        try {
            $header = get_headers($url, 1);
            return $header;
        }
        // If the url could not be found, throw new exception
        catch (\Exception $exception) {
            throw new \Exception("The given URL could not be resolved.");
        }
    }
}

//
// Re-analizeHeaders
// Check
// GetReport