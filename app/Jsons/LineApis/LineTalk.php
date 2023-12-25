<?php

namespace App\Jsons\LineApis;

/**
 * LineTalk
 * 
 */
class LineTalk implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param string          fromTo          FromTo
     * @param string          sendTime　      送信時刻
     * @param string          sender          送信者
     * @param int 　          typeId          送信タイプID
     * @param string          typeName        送信タイプ名
     * @param LineTalkContent lineTalkContent トークコンテンツ
     */
    public function __construct(
        public readonly string $fromTo,
        public readonly string $sendTime,
        public readonly ?string $sender,
        public readonly int $typeId,
        public readonly string $typeName,
        public readonly ?LineTalkContent $lineTalkContent
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