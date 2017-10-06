<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseHeader extends Model
{
    /**
     * Relationship between response headers and response.
     *
     * @return BelongsTo
     */
    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    /**
     * Relationship between response header and response header findings.
     *
     * @return HasMany
     */
    public function responseHeaderFinding() : HasMany
    {
        return $this->hasMany(ResponseHeaderFinding::class);
    }
}
