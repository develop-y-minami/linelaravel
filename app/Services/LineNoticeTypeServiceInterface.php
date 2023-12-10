<?php

namespace App\Services;

/**
 * LineNoticeTypeServiceInterface
 * 
 */
interface LineNoticeTypeServiceInterface
{
    /**
     * 通知種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems();
}