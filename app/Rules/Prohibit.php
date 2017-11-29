<?php

namespace App\Rules;

class Prohibit implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator): Bool
    {
        return is_null($value) || trim($value) === '';
    }
}