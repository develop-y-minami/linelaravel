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
     * 登録
     * 
     * @param int    lineMessageTypeId     LINEメッセージ種別情報ID
     * @param string lineChannelMessageId  LINEメッセージID
     * @param string lineChannelQuoteToken LINEメッセージ引用トークン
     * @param string lineNoticeId          LINE通知情報ID
     * @return LineMessage LINEメッセージ情報
     */
    public function register($lineMessageTypeId, $lineChannelMessageId, $lineChannelQuoteToken, $lineNoticeId)
    {
        return LineMessage::create([
            'line_message_type_id' => $lineMessageTypeId,
            'line_channel_message_id' => $lineChannelMessageId,
            'line_channel_quote_token' => $lineChannelQuoteToken,
            'line_notice_id' => $lineNoticeId,
        ]);
    }
}