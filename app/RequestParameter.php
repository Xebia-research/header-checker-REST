<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestParameter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
    ];

    /**
     * Relationship between request headers and request.
     *
     * @return BelongsTo
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
