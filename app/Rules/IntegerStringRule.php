<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IntegerStringRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the value can be cast to an integer
        dd((int)$value , $value);
        if (!is_numeric($value) || (int)$value != $value) {
            $fail("The $attribute must be an integer.");
        }
    }
}
