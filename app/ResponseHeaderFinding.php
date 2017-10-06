<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseHeaderFinding extends Model
{
    /**
     * Relationship between response header findings and response header.
     *
     * @return BelongsTo
     */
    public function ResponseHeader(): BelongsTo
    {
        return $this->belongsTo(ResponseHeader::class);
    }

    /**
     * Relationship between response header findings and header rule.
     *
     * @return BelongsTo
     */
    public function HeaderRule(): BelongsTo
    {
        return $this->BelongsTo(HeaderRule::class);
    }
}
