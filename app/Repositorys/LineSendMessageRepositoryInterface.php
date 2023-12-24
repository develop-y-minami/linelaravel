<?php

namespace App\Repositorys;

/**
 * LineSendMessageRepositoryInterface
 * 
 */
interface LineSendMessageRepositoryInterface
{
    /**
     * LINE送信メッセージを登録
     * 
     * @param string sendDateTime            LINEメッセージ送信日時
     * @param int    lineSendMessageOriginId LINEメッセージ送信種別
     * @param int    lineSendMessageTypeId   LINEメッセージ種別
     * @param int    lineId                  LINE情報ID
     * @param int    userId                  担当者ID
     * @return LineSendMessage LINE送信メッセージ
     */
    public function create(
        $sendDateTime,
        $lineSendMessageOriginId,
        $lineSendMessageTypeId,
        $lineId,
        $userId
    );
}