<?php

namespace App\Services\Apis;

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
     * @param string replyToken リプライトークン
     * @param string type       タイプ
     * @param string userId     ユーザーID
     * @param int    timestamp  タイムスタンプ
     */
    public function follow($replyToken, $type, $userId, $timestamp);

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
}