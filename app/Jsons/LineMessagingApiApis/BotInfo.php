<?php

namespace App\Jsons\LineMessagingApiApis;

/**
 * BotInfo
 * 
 */
class BotInfo implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param string basicId     ボットのベーシックID
     * @param string displayName ボットの表示名
     * @param string pictureUrl  プロフィール画像のURL
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