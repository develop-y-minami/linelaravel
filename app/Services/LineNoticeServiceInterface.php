<?php

namespace App\Services;

/**
 * LineNoticeServiceInterface
 * 
 */
interface LineNoticeServiceInterface
{
    /**
     * LINE通知情報を返却
     * 
     * @param string noticeDate       通知日
     * @param int    lineNoticeTypeId LINE通知種別
     * @param string displayName      LINE 表示名
     * @param int    userId           担当者ID
     * @return array LINE通知情報
     */
    public function getNotices(
        $noticeDate = null,
        $lineNoticeTypeId = null,
        $displayName = null,
        $userId = null
    );
}