<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\ResponseHeader
 *
 * @property int $id
 * @property int $response_id
 * @property string $name
 * @property string $value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Response $response
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ResponseHeaderFinding[] $responseHeaderFindings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeader whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeader whereResponseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeader whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeader whereValue($value)
 * @mixin \Eloquent
 */
class ResponseHeader extends Model
{
    /**
     * Relationship between Response and ResponseHeader models.
     *
     * @return BelongsTo
     */
    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    /**
     * Relationship between ResponseHeaderFinding and ResponseHeader models.
     *
     * @return HasMany
     */
    public function responseHeaderFindings(): HasMany
    {
        return $this->hasMany(ResponseHeaderFinding::class);
    }
}
