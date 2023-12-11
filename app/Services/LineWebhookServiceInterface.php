<?php

namespace App\Services;

/**
 * LineWebhookServiceInterface
 * 
 */
interface LineWebhookServiceInterface
{
    /**
     * メッセージイベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param array  source    送信元情報
     * @param array  message   メッセージ情報
     * @param int    timestamp タイムスタンプ
     */
    public function message($type, $source, $message, $timestamp);

    /**
     * フォローイベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string userId    ユーザーID
     * @param int    timestamp タイムスタンプ
     */
    public function follow($type, $userId, $timestamp);

    /**
     * フォロー解除イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string userId    ユーザーID
     * @param int    timestamp タイムスタンプ
     */
    public function unfollow($type, $userId, $timestamp);

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