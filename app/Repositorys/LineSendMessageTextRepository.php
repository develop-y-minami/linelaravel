<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineSendMessageText;

/**
 * LineSendMessageTextRepository
 * 
 */
class LineSendMessageTextRepository implements LineSendMessageTextRepositoryInterface
{
    /**
     * LINE送信テキストメッセージを登録
     * 
     * @param int    lineSendMessageId LINE送信メッセージID
     * @param string text              テキスト
     * @return LineSendMessageText LINE送信テキストメッセージ
     */
    public function create($lineSendMessageId, $text)
    {
        return LineSendMessageText::create(['line_send_message_id' => $lineSendMessageId, 'text' => $text]);
    }
}