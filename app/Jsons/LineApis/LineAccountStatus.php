<?php

namespace App\Jsons\LineApis;

/**
 * LineAccountStatus
 * 
 * LINEアカウント状態情報
 * 
 */
class LineAccountStatus implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id   ID
     * @param string name 状態名
     */
    public function __construct(public readonly ?int $id, public readonly ?string $name)
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