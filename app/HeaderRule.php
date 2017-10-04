<?php
/**
 * Created by PhpStorm.
 * User: casper
 * Date: 4-10-2017
 * Time: 11:17
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeaderRule extends Model
{
    /**
     * Relationship between ResponseHeaderFinding and HeaderRule.
     *
     * @return HasMany
     */
    public function ResponseHeaderFinding(): HasMany
    {
        return $this->HasMany(ResponsHeaderFinding :: class);
    }

    /**
     * Relationship between ResponseHeaderValue and HeaderRule.
     *
     * @return HasMany
     */
    public function HeaderRuleValue(): HasMany
    {
        return $this->hasMany(HeaderRuleValue::class);
    }


}