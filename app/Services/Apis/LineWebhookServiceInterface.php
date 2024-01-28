<?php

namespace App\Services\Apis;

/**
 * LineWebhookServiceInterface
 * 
 * LINE Webhook
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
     * @param string mode       チャネル状態
     * @param string replyToken リプライトークン
     * @param string type       タイプ
     * @param string userId     ユーザーID
     * @param int    timestamp  タイムスタンプ
     */
    public function follow($mode, $replyToken, $type, $userId, $timestamp);

    /**
     * フォロー解除イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string userId    ユーザーID
     * @param int    timestamp タイムスタンプ
     */
    public function unfollow($type, $userId, $timestamp);

    /**
     * グループ参加イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string groupId   グループID
     * @param int    timestamp タイムスタンプ
     */
    public function join($type, $groupId, $timestamp);

    /**
     * グループ退出イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string groupId   グループID
     * @param int    timestamp タイムスタンプ
     */
    public function leave($type, $groupId, $timestamp);

    /**
     * グループメンバー退出イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string groupId   グループID
     * @param array  members   退出メンバー情報
     * @param int    timestamp タイムスタンプ
     */
    public function memberLeft($type, $groupId, $members, $timestamp);
}