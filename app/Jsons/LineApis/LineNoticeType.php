<?php

namespace App\Jsons\LineApis;

/**
 * LineNoticeType
 * 
 */
class LineNoticeType implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id          ID
     * @param string displayName LINE通知種別
     */
    public function __construct(public readonly int $id, public readonly string $displayName)
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