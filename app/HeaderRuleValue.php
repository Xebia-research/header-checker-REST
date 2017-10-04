<?php
/**
 * Created by PhpStorm.
 * User: casper
 * Date: 4-10-2017
 * Time: 11:29
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeaderRuleValue extends Model
{
    /**
     * Relationship between HeaderRule and HeaderRuleValue.
     *
     * @return HasMany
     */
    public function HeaderRule(): BelongsTo
    {
        return $this->BelongsTo(HeaderRule::class);
    }


}