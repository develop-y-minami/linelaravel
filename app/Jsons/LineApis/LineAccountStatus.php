<?php

namespace App\Jsons\LineApis;

/**
 * LineAccountStatus
 * 
 */
class LineAccountStatus implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id   ID
     * @param string name LINEアカウント状態
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