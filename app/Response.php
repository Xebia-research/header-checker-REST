<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Response
 *
 * @property int $id
 * @property int $request_id
 * @property int $status_code
 * @property string $reason_phrase
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Request $request
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ResponseHeaderFinding[] $responseHeaderFindings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ResponseHeader[] $responseHeaders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereReasonPhrase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Response extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_code',
        'reason_phrase',
    ];

    /**
     * Relationship between Request and Response models.
     *
     * @return BelongsTo
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    /**
     * Relationship between ResponseHeader and Response models.
     *
     * @return HasMany
     */
    public function responseHeaders(): HasMany
    {
        return $this->hasMany(ResponseHeader::class);
    }

    /**
     * Relationship between ResponseHeaderFinding and Response models, through ResponseHeader model.
     *
     * @return HasManyThrough
     */
    public function responseHeaderFindings(): HasManyThrough
    {
        return $this->hasManyThrough(ResponseHeaderFinding::class, ResponseHeader::class);
    }
}
