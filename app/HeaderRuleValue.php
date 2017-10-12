<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\HeaderRuleValue
 *
 * @property int $id
 * @property int $header_rule_id
 * @property string $value_type
 * @property string $value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\HeaderRule $headerRule
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRuleValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRuleValue whereHeaderRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRuleValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRuleValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRuleValue whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRuleValue whereValueType($value)
 * @mixin \Eloquent
 */
class HeaderRuleValue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value_type',
        'value',
    ];

    /**
     * Relationship between HeaderRule and HeaderRuleValue models.
     *
     * @return BelongsTo
     */
    public function headerRule(): BelongsTo
    {
        return $this->belongsTo(HeaderRule::class);
    }
}
