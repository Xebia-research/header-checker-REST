<?php

namespace App\ApplicationProfiles;

use App\HeaderRules\HeaderRule;
use Illuminate\Support\Collection;
use App\ApplicationProfiles\Contracts\Profile;

abstract class ApplicationProfile implements Profile
{
    /**
     * The application profile's header rule stack.
     *
     * @var HeaderRule[]
     */
    protected $headerRules = [];

    /**
     * @return Collection
     */
    public function getHeaderRules(): Collection
    {
        return collect($this->headerRules);
    }
}
