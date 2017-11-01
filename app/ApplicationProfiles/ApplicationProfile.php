<?php

namespace App\ApplicationProfiles;

use App\ApplicationProfiles\Contracts\Profile;
use Illuminate\Support\Collection;

abstract class ApplicationProfile implements Profile
{
    /**
     * The application profile's header rule stack.
     *
     * @var array
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
