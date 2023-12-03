<?php

namespace App\Services;

/**
 * LineServiceInterface
 * 
 */
interface LineServiceInterface
{
    /**
     * ボットの情報を取得する
     * 
     * @return BotInfo
     */
    public function getBotInfo();

    /**
     * TextMessageを返却
     * 
     * @param string text メッセージ
     * 
     * @return TextMessage
     */
    public function getTextMessage($text);

    /**
     * FlexMessageを返却
     * 
     * @param string altText  メッセージ
     * @param string contents 表示コンテンツ
     * 
     * @return FlexMessage
     */
    public function getFlexMessage($altText, $contents);

    /**
     * リプライメッセージを送信
     * 
     * @param string replyToken リプライトークン
     * @param string text メッセージ
     * 
     * @return ReplyMessageResponse
     */
    public function replyTextMessage($replyToken, $text);

    /**
     * リプライメッセージ(複数)を送信
     * 
     * @param string replyToken リプライトークン
     * @param array  messages   メッセージ
     * 
     * @return ReplyMessageResponse
     */
    public function replyTextMessages($replyToken, $messages);

    /**
     * 友達追加時のリプライメッセージを送信
     * 
     * @param string replyToken リプライトークン
     * 
     * @return ReplyMessageResponse
     */
    public function replyFollow($replyToken);
}