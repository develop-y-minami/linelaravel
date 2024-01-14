<?php

namespace App\Repositorys;

/**
 * LineNoticeUserSettingRepositoryInterface
 * 
 */
interface LineNoticeUserSettingRepositoryInterface
{
    /**
     * LINE通知担当者設定情報を取得
     * 
     * @param int lineId LINE情報ID
     * @return Collection LINE通知担当者設定情報
     */
    public function findByLineId($lineId);
    
    /**
     * LINE通知担当者設定情報を削除
     * 
     * @param int lineId LINE情報ID
     * @return int 削除件数
     */
    public function deleteByLineId($lineId);

    /**
     * LINE通知担当者設定情報を作成
     * 
     * @param int   lineId            LINE情報ID
     * @param array lineNoticeSttings LINE通知担当者種別
     * @return Collection LINE通知担当者設定情報
     */
    public function inserts($lineId, $lineNoticeSttings);
}