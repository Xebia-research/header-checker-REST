<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeaderRuleValue extends Model
{
    /**
     * Relationship between HeaderRule and HeaderRuleValue.
     *
     * @return HasMany
     */
    public function HeaderRule(): BelongsTo
    {
        return $this->BelongsTo(HeaderRule::class);
    }
}
