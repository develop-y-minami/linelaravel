<?php

namespace App\Jsons\LineApis;

/**
 * LineNoticeType
 * 
 * LINE通知種別情報
 * 
 */
class LineNoticeType implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id          ID
     * @param string displayName 表示名
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