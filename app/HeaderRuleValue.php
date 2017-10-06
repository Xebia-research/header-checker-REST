<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeaderRuleValue extends Model
{
    /**
     * Relationship between header rules value and header rule.
     *
     * @return BelongsTo
     */
    public function HeaderRule(): BelongsTo
    {
        return $this->BelongsTo(HeaderRule::class);
    }
}
