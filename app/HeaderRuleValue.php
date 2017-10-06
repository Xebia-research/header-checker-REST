<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeaderRuleValue extends Model
{
    /**
     * Relationship between HeaderRule and HeaderRuleValue models.
     *
     * @return BelongsTo
     */
    public function headerRule(): BelongsTo
    {
        return $this->belongsTo(HeaderRule::class);
    }
}
