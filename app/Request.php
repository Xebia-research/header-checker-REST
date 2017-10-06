<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    /**
     * Allowed methods.
     *
     * @var array
     */
    private static $allowedMethods = [
        'GET',
        'HEAD',
        'POST',
        'PUT',
        'DELETE',
        'CONNECT',
        'OPTIONS',
        'TRACE',
        'PATCH',
    ];

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

    /**
     * @return array
     */
    public static function getAllowedMethods(): array
    {
        return self::$allowedMethods;
    }
}
