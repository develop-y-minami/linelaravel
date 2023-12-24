<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineMessage;

/**
 * LineMessageRepository
 * 
 */
class LineMessageRepository implements LineMessageRepositoryInterface
{
    /**
     * LINEメッセージ情報を登録
     * 
     * @param int    lineMessageTypeId LINEメッセージ種別
     * @param string messageId         メッセージID
     * @param string quoteToken        メッセージの引用トークン
     * @return LineMessage LINEメッセージ情報
     */
    public function create($lineMessageTypeId, $messageId, $quoteToken)
    {
        return LineMessage::create([
            'line_message_type_id' => $lineMessageTypeId,
            'message_id' => $messageId,
            'quote_token' => $quoteToken
        ]);
    }
}