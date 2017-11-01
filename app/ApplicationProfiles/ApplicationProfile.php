<?php

namespace App\ApplicationProfiles;

use App\ApplicationProfiles\Contracts\Profile;

abstract class ApplicationProfile implements Profile
{
    /**
     * The application profile's header rule stack.
     *
     * @var array
     */
    protected $headerRules = [];

    /**
     * @return array
     */
    public function getHeaderRules(): array
    {
        return $this->headerRules;
    }
}
