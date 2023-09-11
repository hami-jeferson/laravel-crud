<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class MobilePhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneUtil->parse($value, 'IR');
            $isValid = $phoneUtil->isValidNumber($phoneNumber) && $phoneUtil->getNumberType($phoneNumber) === \libphonenumber\PhoneNumberType::MOBILE;

            if (!$isValid) {
                $fail("The $attribute is not a valid Iran mobile number.");
            }
        } catch (\libphonenumber\NumberFormatException $e) {
            $fail("The $attribute is not a valid phone number.");
        }
    }
}
