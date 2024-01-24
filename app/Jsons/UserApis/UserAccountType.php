<?php

namespace App\Jsons\UserApis;

/**
 * UserAccountType
 * 
 * 担当者アカウント種別情報
 * 
 */
class UserAccountType implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id   ID
     * @param string name 種別名
     */
    public function __construct(public readonly int $id, public readonly ?string $name)
    {

    }

    /**
     * jsonSerialize
     * 
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}