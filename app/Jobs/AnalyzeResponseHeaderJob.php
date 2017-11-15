<?php

namespace App\Jobs;

use Illuminate\Database\Eloquent\Collection;
use App\ApplicationProfiles\ApplicationProfileFactory;

class AnalyzeResponseHeaderJob extends Job
{
    /**
     * @var \App\ApplicationProfiles\ApplicationProfile
     */
    private $applicationProfile;

    /**
     * @var Collection
     */
    private $responseHeaders;

    /**
     * @param string $profileIdentifier
     * @param Collection $responseHeaders
     */
    public function __construct(string $profileIdentifier, Collection $responseHeaders)
    {
        $this->applicationProfile = ApplicationProfileFactory::build($profileIdentifier);
        $this->responseHeaders = $responseHeaders;
    }

    public function handle()
    {
        // TODO: Analyze `$this->responseHeaders` against `$this->applicationProfile->getHeaderRules()`
    }
}
