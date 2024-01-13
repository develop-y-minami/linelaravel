<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * HalfSize
 * 
 */
class HalfSize implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ((mb_strlen($value) == mb_strwidth($value)) == false)
        {
            $fail(':attributeに全角文字が含まれています');
        }
    }
}
