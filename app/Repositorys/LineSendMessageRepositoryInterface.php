<?php

namespace App\Repositorys;

/**
 * LineSendMessageRepositoryInterface
 * 
 * LINE送信メッセージ情報
 * 
 */
interface LineSendMessageRepositoryInterface
{
    /**
     * 登録
     * 
     * @param string sendDateTime            LINEメッセージ送信日時
     * @param int    lineSendMessageOriginId LINE送信メッセージ発生元情報ID
     * @param int    lineSendMessageTypeId   LINE送信メッセージ種別情報ID
     * @param int    lineId                  LINE情報ID
     * @param int    userId                  担当者情報ID
     * @return LineSendMessage LINE送信メッセージ
     */
    public function register($sendDateTime, $lineSendMessageOriginId, $lineSendMessageTypeId, $lineId, $userId);
}