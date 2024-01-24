<?php

namespace App\Objects;

/**
 * UserSelectItem
 * 
 * 担当者情報セレクトボックス選択項目
 * 
 */
class UserSelectItem extends SelectItem
{
    /**
     * __construct
     * 
     * @param string value             value属性
     * @param string name              項目名
     * @param string serviceProviderId サービス提供者ID
     */
    public function __construct($value, $name, public readonly ?string $serviceProviderId)
    {
        parent::__construct($value, $name);
    }
}