<?php

namespace App\Services\Webs;

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

    /**
     * LINE通知種別チェックリストに設定するデータを返却
     * 
     * @param int lineId LINE情報ID
     * @return array 選択項目
     */
    public function getCheckListItems($lineId);
}