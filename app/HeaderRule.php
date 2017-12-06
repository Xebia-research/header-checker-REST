<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HeaderRule extends Model
{
    /**
     * Relationship between HeaderRule and Profile models.
     *
     * @return BelongsToMany
     */
    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'profile_header_rule');
    }

    /**
     * Create validation_rule attribute for the ValidateResponseJob.
     *
     * @return string
     */
    public function getValidationRuleAttribute(): string
    {
        $validationRule = $this->validation_type;
        if ($this->validation_value) {
            $validationRule .= ':'.$this->validation_value;
        }

        return $validationRule;
    }
}
