<?php

namespace App\Services;

/**
 * LineServiceInterface
 * 
 */
interface LineServiceInterface
{
    /**
     * LINE情報を返却
     * 
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    userId              担当者ID
     * @return array LINE通知情報
     */
    public function getLines(
        $lineAccountTypeId = null,
        $lineAccountStatusId = null,
        $displayName = null,
        $userId = null
    );
}