<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeaderRule extends Model
{
    /**
     * Relationship between header rule and response header findings.
     *
     * @return HasMany
     */
    public function responseHeaderFindings(): HasMany
    {
        return $this->HasMany(ResponseHeaderFinding::class);
    }

    /**
     * Relationship between header rule and header rule values.
     *
     * @return HasMany
     */
    public function HeaderRuleValue(): HasMany
    {
        return $this->hasMany(HeaderRuleValue::class);
    }
}
