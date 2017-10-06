<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseHeaderFinding extends Model
{
    /**
     * Relationship between ResponseHeader and ResponseHeaderFinding models.
     *
     * @return BelongsTo
     */
    public function responseHeader(): BelongsTo
    {
        return $this->belongsTo(ResponseHeader::class);
    }

    /**
     * Relationship between HeaderRule and ResponseHeaderFinding models.
     *
     * @return BelongsTo
     */
    public function headerRule(): BelongsTo
    {
        return $this->belongsTo(HeaderRule::class);
    }
}
