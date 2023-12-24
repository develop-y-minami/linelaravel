<?php

namespace App\Repositorys;

/**
 * LineSendMessageTextRepositoryInterface
 * 
 */
interface LineSendMessageTextRepositoryInterface
{
    /**
     * LINE送信テキストメッセージを登録
     * 
     * @param int    lineSendMessageId LINE送信メッセージID
     * @param string text              テキスト
     * @return LineSendMessageText LINE送信テキストメッセージ
     */
    public function create($lineSendMessageId, $text);
}