<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Response extends Model
{
    /**
     * Relationship between Request and Response models.
     *
     * @return BelongsTo
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    /**
     * Relationship between ResponseHeader and Response models.
     *
     * @return HasMany
     */
    public function responseHeaders(): HasMany
    {
        return $this->hasMany(ResponseHeader::class);
    }

    /**
     * Relationship between ResponseHeaderFinding and Response models, through ResponseHeader model.
     *
     * @return HasManyThrough
     */
    public function responseHeaderFindings(): HasManyThrough
    {
        return $this->hasManyThrough(ResponseHeaderFinding::class, ResponseHeader::class);
    }
}
