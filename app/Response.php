<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Response extends Model
{
    /**
     * Relationship between response headers and a response.
     *
     * @return HasMany
     */
    public function responseHeaders(): HasMany
    {
        return $this->hasMany(ResponseHeader::class);
    }

    /**
     * Relationship between reponses and request.
     *
     * @return BelongsTo
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
