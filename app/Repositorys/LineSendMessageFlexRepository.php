<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineSendMessageFlex;

/**
 * LineSendMessageFlexRepository
 * 
 * LINE送信メッセージFlex情報
 * 
 */
class LineSendMessageFlexRepository implements LineSendMessageFlexRepositoryInterface
{
    /**
     * 登録
     * 
     * @param int    lineSendMessageId LINE送信メッセージ情報ID
     * @param int    liffPageTypeId    LIFFページ種別情報ID
     * @param string altText           通知テキスト
     * @param string content           Flexコンテンツ
     * @return LineSendMessageFlex LINE送信メッセージFlex情報
     */
    public function register($lineSendMessageId, $liffPageTypeId, $altText, $content)
    {
        return LineSendMessageFlex::create(['line_send_message_id' => $lineSendMessageId, 'liff_page_type_id' => $liffPageTypeId, 'alt_text' => $altText, 'content' => $content]);
    }
}