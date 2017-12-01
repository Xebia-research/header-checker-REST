<?php

namespace App\Rules;

class Equal implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param mixed $value
     * @param $parameters
     * @param $validator
     * @return bool
     * @internal param mixed $value
     */
    public function validate($attribute, $value, $parameters, $validator): Bool
    {
        return $value === $parameters[0];
    }
}
