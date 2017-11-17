<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'error_message',
    ];

    /**
     * Attributes that should be visible when calling toJson().
     *
     * @var array
     */
    protected $visible = [
        'id',
        'endpoint_id',
        'error_message',
        'created_at',
        'updated_at',
    ];

    /**
     * Relationship between Endpoint and Request models.
     *
     * @return BelongsTo
     */
    public function endpoint(): BelongsTo
    {
        return $this->belongsTo(Endpoint::class);
    }

    /**
     * Relationship between Response and Request models.
     *
     * @return HasMany
     */
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    /**
     * Relationship between RequestHeader and Request models.
     *
     * @return HasMany
     */
    public function requestHeaders(): HasMany
    {
        return $this->hasMany(RequestHeader::class);
    }

    /**
     * Relationship between ResponseHeader and Request models, through Response model.
     *
     * @return HasManyThrough
     */
    public function responseHeaders(): HasManyThrough
    {
        return $this->hasManyThrough(ResponseHeader::class, Response::class);
    }

    /**
     * @return array
     */
    public static function getAllowedMethods(): array
    {
        return self::$allowedMethods;
    }
}
