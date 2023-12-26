<?php

namespace App\Services\Apis;

/**
 * LineMessagingApiServiceInterface
 * 
 */
interface LineMessagingApiServiceInterface
{
    /**
     * ボットの情報を取得する
     * 
     * @return LineBotInfo
     */
    public function getBotInfo();

    public function getMessageContent($messageId);
}