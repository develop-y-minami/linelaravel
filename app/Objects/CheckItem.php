<?php

namespace App\Objects;

/**
 * CheckItem
 * 
 * チェックボックス
 * 
 */
class CheckItem
{
    /**
     * __construct
     * 
     * @param string value   value属性
     * @param string name    項目名
     * @param bool   checked チェック状態
     */
    public function __construct(public readonly string $value, public readonly string $name, public readonly bool $checked = false)
    {
        
    }
}