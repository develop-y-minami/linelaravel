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
     * @param string type       メッセージタイプ
     * @param string messageId  メッセージID
     * @param string quoteToken メッセージの引用トークン
     * @return LineMessage LINEメッセージ情報
     */
    public function create($type, $messageId, $quoteToken)
    {
        return LineMessage::create([
            'type' => $type,
            'message_id' => $messageId,
            'quote_token' => $quoteToken
        ]);
    }
}