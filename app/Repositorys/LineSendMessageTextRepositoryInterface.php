<?php

namespace App\Repositorys;

/**
 * LineSendMessageTextRepositoryInterface
 * 
 * LINE送信メッセージテキスト情報
 * 
 */
interface LineSendMessageTextRepositoryInterface
{
    /**
     * 登録
     * 
     * @param int    lineSendMessageId LINE送信メッセージ情報ID
     * @param string text              テキスト
     * @return LineSendMessageText LINE送信メッセージテキスト情報
     */
    public function register($lineSendMessageId, $text);
}