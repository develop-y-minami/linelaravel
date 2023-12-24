<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineSendMessage;

/**
 * LineSendMessageRepository
 * 
 */
class LineSendMessageRepository implements LineSendMessageRepositoryInterface
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
    )
    {
        return LineSendMessage::create([
            'send_date_time' => $sendDateTime,
            'line_send_message_origin_id' => $lineSendMessageOriginId,
            'line_send_message_type_id' => $lineSendMessageTypeId,
            'line_id' => $lineId,
            'user_id' => $userId
        ]);
    }
}