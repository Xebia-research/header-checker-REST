<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\ResponseHeaderFinding
 *
 * @property int $id
 * @property int $response_header_id
 * @property int $header_rule_id
 * @property int $score
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\HeaderRule $headerRule
 * @property-read \App\ResponseHeader $responseHeader
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeaderFinding whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeaderFinding whereHeaderRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeaderFinding whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeaderFinding whereResponseHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeaderFinding whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResponseHeaderFinding whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ResponseHeaderFinding extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score',
    ];

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
