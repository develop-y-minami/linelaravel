<?php

namespace App\Jsons\UserApis;

/**
 * UserType
 * 
 * 担当者種別情報
 * 
 */
class UserType implements \JsonSerializable
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