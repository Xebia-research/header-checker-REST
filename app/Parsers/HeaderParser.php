<?php

namespace App\Parsers;
/**
 * Created by PhpStorm.
 * User: casper
 * Date: 22-9-2017
 * Time: 12:13
 */

class HeaderParser
{
    // Function that retrieves the headers and returns them in form of an array
    public static function getAllHeaders($url)
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