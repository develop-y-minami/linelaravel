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

    /**
     * メッセージコンテンツを取得
     * 
     * @param string messageId メッセージID
     * @return string メッセージコンテンツ
     */
    public function getMessageContent($messageId);
}