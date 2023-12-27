<?php

namespace App\Repositorys;

/**
 * LineOfUserNoticeSettingRepositoryInterface
 * 
 */
interface LineOfUserNoticeSettingRepositoryInterface
{
    /**
     * LINE担当者通知設定情報を取得
     * 
     * @param int lineId LINE情報ID
     * @return Collection LINE担当者通知設定情報
     */
    public function findByLineId($lineId);
    
    /**
     * LINE担当者通知設定情報を削除
     * 
     * @param int lineId LINE情報ID
     * @return int 削除件数
     */
    public function deleteByLineId($lineId);

    /**
     * LINE担当者通知設定情報を作成
     * 
     * @param int   lineId            LINE情報ID
     * @param array lineNoticeSttings LINE通知種別
     * @return Collection LINE担当者通知設定情報
     */
    public function inserts($lineId, $lineNoticeSttings);
}