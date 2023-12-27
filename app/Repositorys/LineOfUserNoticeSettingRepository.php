<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineOfUserNoticeSetting;

/**
 * LineOfUserNoticeSettingRepository
 * 
 */
class LineOfUserNoticeSettingRepository implements LineOfUserNoticeSettingRepositoryInterface
{
    /**
     * LINE担当者通知設定情報を取得
     * 
     * @param int lineId LINE情報ID
     * @return Collection LINE担当者通知設定情報
     */
    public function findByLineId($lineId)
    {
        return LineOfUserNoticeSetting::whereLineId($lineId)->get();
    }

    /**
     * LINE担当者通知設定情報を削除
     * 
     * @param int lineId LINE情報ID
     * @return int 削除数
     */
    public function deleteByLineId($lineId)
    {
        return LineOfUserNoticeSetting::whereLineId($lineId)->delete();
    }

    /**
     * LINE担当者通知設定情報を作成
     * 
     * @param int   lineId            LINE情報ID
     * @param array lineNoticeSttings LINE通知種別
     * @return Collection LINE担当者通知設定情報
     */
    public function inserts($lineId, $lineNoticeSttings)
    {
        $datas = array();
        foreach ($lineNoticeSttings as $lineNoticeTypeId)
        {
            $datas[] = ['line_id' => $lineId, 'line_notice_type_id' => $lineNoticeTypeId];
        }
        return LineOfUserNoticeSetting::insert($datas);
    }
}