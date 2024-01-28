<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineSendMessage;

/**
 * LineSendMessageRepository
 * 
 * LINE送信メッセージ情報
 * 
 */
class LineSendMessageRepository implements LineSendMessageRepositoryInterface
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
    public function register($sendDateTime, $lineSendMessageOriginId, $lineSendMessageTypeId, $lineId, $userId)
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