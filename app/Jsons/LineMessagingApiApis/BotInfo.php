<?php

namespace App\Jsons\LineMessagingApiApis;

/**
 * BotInfo
 * 
 * ボット情報
 * 
 */
class BotInfo implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param string basicId     ベーシックID
     * @param string displayName 表示名
     * @param string pictureUrl  プロフィール画像URL
     */
    public function __construct(
        public readonly string $basicId,
        public readonly ?string $displayName,
        public readonly ?string $pictureUrl
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