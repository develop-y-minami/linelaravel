<?php

namespace App\Services;

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
}