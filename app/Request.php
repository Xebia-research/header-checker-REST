<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Request
 *
 * @property int $id
 * @property int $endpoint_id
 * @property string|null $error_message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Endpoint $endpoint
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ResponseHeader[] $responseHeaders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Response[] $responses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Request whereEndpointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Request whereErrorMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Request whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
