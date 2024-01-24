<?php

namespace App\Jsons\LineMessagingApiApis\Responses;

use App\Jsons\LineMessagingApiApis\BotInfo;

/**
 * BotInfoResponse
 * 
 * ボット情報取得レスポンス
 * 
 */
class BotInfoResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param string LineBotInfo ボット情報
     */
    public function __construct(public readonly BotInfo $botInfo)
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