<?php

namespace App\Http\Response;

use Illuminate\Http\Request;

trait Responseable
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * Responseable constructor.
     *
     * @param Response $response
     */
    public function __construct(Request $request, Response $response) {
        $response->setRequest($request);

        $this->response = $response;
    }
}