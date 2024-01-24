<?php

namespace App\Jsons\LineApis;

/**
 * LineNotice
 * 
 * LINE通知情報
 * 
 */
class LineNotice implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int            id             ID
     * @param string         noticeDateTime 通知日時
     * @param string         content　　　　 通知内容
     * @param LineNoticeType lineNoticeType LINE通知種別情報
     * @param Line           line           LINE情報
     */
    public function __construct(
        public readonly int $id,
        public readonly string $noticeDateTime,
        public readonly ?string $content,
        public readonly LineNoticeType $lineNoticeType,
        public readonly Line $line
    )
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