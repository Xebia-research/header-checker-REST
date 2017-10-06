<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeaderRule extends Model
{
    /**
     * Relationship between ResponseHeaderFinding and HeaderRule models.
     *
     * @return HasMany
     */
    public function responseHeaderFindings(): HasMany
    {
        return $this->hasMany(ResponseHeaderFinding::class);
    }

    /**
     * Relationship between HeaderRuleValue and HeaderRule models.
     *
     * @return HasMany
     */
    public function headerRuleValues(): HasMany
    {
        return $this->hasMany(HeaderRuleValue::class);
    }
}
