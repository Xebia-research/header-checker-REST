<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseHeader extends Model
{
    /**
     * Relationship between Response and ResponseHeader models.
     *
     * @return BelongsTo
     */
    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    /**
     * Relationship between ResponseHeaderFinding and ResponseHeader models.
     *
     * @return HasMany
     */
    public function responseHeaderFindings(): HasMany
    {
        return $this->hasMany(ResponseHeaderFinding::class);
    }
}
