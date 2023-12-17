<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * LineNoticeSttings
 * 
 */
class LineNoticeSttings implements ValidationRule
{
    /**
     * 通知設定フラグ
     * 
     */
    private $noticeSetting;

    /**
     * __construct
     * 
     * @param bool noticeSetting 通知設定フラグ
     */
    public function __construct($noticeSetting)
    {
        $this->noticeSetting = $noticeSetting;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->noticeSetting != null)
        {
            if ($this->noticeSetting == true && count($value) == 0)
            {
                $fail('通知種別を選択してください');
            }
        }
    }
}
