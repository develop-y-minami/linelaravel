<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineSendMessageText;

/**
 * LineSendMessageTextRepository
 * 
 * LINE送信メッセージテキスト情報
 * 
 */
class LineSendMessageTextRepository implements LineSendMessageTextRepositoryInterface
{
    /**
     * 登録
     * 
     * @param int    lineSendMessageId LINE送信メッセージ情報ID
     * @param string text              テキスト
     * @return LineSendMessageText LINE送信メッセージテキスト情報
     */
    public function register($lineSendMessageId, $text)
    {
        return LineSendMessageText::create(['line_send_message_id' => $lineSendMessageId, 'text' => $text]);
    }
}