<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\HeaderRule.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $rule_type
 * @property int $score
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HeaderRuleValue[] $headerRuleValues
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ResponseHeaderFinding[] $responseHeaderFindings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRule whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRule whereRuleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRule whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HeaderRule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HeaderRule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'rule_type',
        'score',
    ];

    /**
     * Relationship between ResponseHeaderFinding and HeaderRule models.
     *
     * @return HasMany
     */
    public function responseHeaderFindings(): HasMany
    {
        return $this->hasMany(ResponseHeaderFinding::class);
    }

    /**
     * Relationship between HeaderRuleValue and HeaderRule models.
     *
     * @return HasMany
     */
    public function headerRuleValues(): HasMany
    {
        return $this->hasMany(HeaderRuleValue::class);
    }
}
