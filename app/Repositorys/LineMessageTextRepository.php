<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineMessageText;

/**
 * LineMessageTextRepository
 * 
 */
class LineMessageTextRepository implements LineMessageTextRepositoryInterface
{
    /**
     * 登録
     * 
     * @param int    lineMessageId LINEメッセージ情報ID
     * @param string text          メッセージ
     * @return LineMessageText LINEメッセージテキスト情報
     */
    public function register($lineMessageId, $text)
    {
        return LineMessageText::create([
            'line_message_id' => $lineMessageId,
            'text' => $text
        ]);
    }
}