<?php

namespace App\Services\Apis;

/**
 * LineApiServiceInterface
 * 
 */
interface LineApiServiceInterface
{
    /**
     * LINE情報を返却
     * 
     * @param int id ID
     * @return Line LINE情報
     */
    public function getLine($id);
    
    /**
     * LINE情報を返却
     * 
     * @param int    lineAccountTypeId      LINEアカウント種別情報ID
     * @param int    lineAccountStatusId    LINEアカウント状態情報ID
     * @param string lineChannelDisplayName LINEプロフィール表示名
     * @param int    serviceProviderId      サービス提供者情報ID
     * @param int    userId                 担当者情報ID
     * @return array LINE情報
     */
    public function getLines($lineAccountTypeId = null, $lineAccountStatusId = null, $lineChannelDisplayName = null, $serviceProviderId = null, $userId = null);

    /**
     * LINE通知情報を返却
     * 
     * @param string noticeDate             通知日
     * @param int    lineNoticeTypeId       LINE通知種別情報ID
     * @param string lineChannelDisplayName LINEプロフィール表示名
     * @param int    serviceProviderId      サービス提供者情報ID
     * @param int    userId                 担当者情報ID
     * @return array LINE通知情報
     */
    public function getNotices($noticeDate = null, $lineNoticeTypeId = null, $lineChannelDisplayName = null, $serviceProviderId = null, $userId = null);

    /**
     * サービス提供者情報を更新
     * 
     * @param array ids               LINE情報ID
     * @param int   serviceProviderId サービス提供者ID
     * @return array LINE情報
     */
    public function updatesServiceProvider($ids, $serviceProviderId);

    /**
     * LINE担当者情報を設定
     * 
     * @param int   id                LINE情報ID
     * @param bool  noticeSetting     LINE通知設定
     * @param array lineNoticeSttings LINE通知種別設定
     * @param int   userId            担当者ID
     */
    public function userSetting($id, $noticeSetting, $lineNoticeSttings, $userId);

    /**
     * LINEトーク履歴を取得
     * 
     * @param int id                  LINE情報ID
     * @param int lineTalkHistoryTerm LINEトーク履歴表示期間
     * @return array LINEトーク履歴
     */
    public function talkHistorys($id, $lineTalkHistoryTerm);
}