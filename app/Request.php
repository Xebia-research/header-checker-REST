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
        'profile_id',
        'error_message',
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
     * Relationship between RequestParameter and Request models.
     *
     * @return HasMany
     */
    public function requestParameters(): HasMany
    {
        return $this->hasMany(RequestParameter::class);
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
     * Relationship between Request and Profile models.
     *
     * @return BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * @return array
     */
    public static function getAllowedMethods(): array
    {
        return self::$allowedMethods;
    }
}
