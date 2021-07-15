<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InArray implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $valueArray;

    public function __construct($valueArray)
    {
        $this->valueArray = $valueArray;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, $this->valueArray);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not valid.';
    }
}
