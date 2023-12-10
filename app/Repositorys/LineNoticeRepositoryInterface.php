<?php

namespace App\Repositorys;

/**
 * LineNoticeRepositoryInterface
 * 
 */
interface LineNoticeRepositoryInterface
{
    /**
     * LINE通知情報を取得
     * 
     * @param string noticeDate       通知日
     * @param int    lineNoticeTypeId LINE通知種別
     * @param string displayName      LINE 表示名
     * @param int    userId           担当者ID
     * @return Collection LINE通知情報
     */
    public function findByconditions(
        $noticeDate = null,
        $lineNoticeTypeId = null,
        $displayName = null,
        $userId = null
    );
}