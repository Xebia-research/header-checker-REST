<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    /**
     * Relationship between requests and endpoint.
     *
     * @return BelongsTo
     */
    public function endpoint(): BelongsTo
    {
        return $this->belongsTo(Endpoint::class);
    }

    /**
     * Relationship between request and responses.
     *
     * @return HasMany
     */
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }
}