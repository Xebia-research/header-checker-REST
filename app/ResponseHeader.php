<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseHeader extends Model
{
    public function reponse(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
}
