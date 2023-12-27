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
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    userId              担当者ID
     * @return array LINE情報
     */
    public function getLines(
        $lineAccountTypeId = null,
        $lineAccountStatusId = null,
        $displayName = null,
        $userId = null
    );

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