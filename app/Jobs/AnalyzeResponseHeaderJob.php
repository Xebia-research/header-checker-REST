<?php

namespace App\Jobs;

use Illuminate\Database\Eloquent\Collection;

class AnalyzeResponseHeaderJob extends Job
{
    /**
     * @var Collection
     */
    private $responseHeaders;

    /**
     * @param Collection $responseHeaders
     */
    public function __construct(Collection $responseHeaders)
    {
        $this->responseHeaders = $responseHeaders;
    }

    public function handle()
    {
        //
    }
}
