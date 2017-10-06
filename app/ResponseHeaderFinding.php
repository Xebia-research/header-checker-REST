<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseHeaderFinding extends Model
{
    /**
     * Relationship between ResponseHeader and ResponseHeaderFinding.
     *
     * @return HasMany
     */
    public function ResponseHeader(): BelongsTo
    {
        return $this->belongsTo(ResponseHeader::class);
    }

    /**
     * Relationship between HeaderRule and ResponseHeaderFind
     * i
     * ng.
     *
     * @return HasMany
     */
    public function HeaderRule(): BelongsTo
    {
        return $this->BelongsTo(HeaderRule :: class);
    }
}
