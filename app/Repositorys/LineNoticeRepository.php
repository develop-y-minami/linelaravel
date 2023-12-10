<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineNotice;

/**
 * LineNoticeRepository
 * 
 */
class LineNoticeRepository implements LineNoticeRepositoryInterface
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
    )
    {
        $query = LineNotice::query();

        $query->with(['line.lineAccountType']);

        // 通知日
        if ($noticeDate != null) $query->where('notice_date_time', 'LIKE', "$noticeDate%");

        // LINE通知種別
        $query->withWhereHas('lineNoticeType', function($query) use ($lineNoticeTypeId) {
            if ($lineNoticeTypeId != null) $query->whereId($lineNoticeTypeId);
        });

        // LINE 表示名
        $query->withWhereHas('line', function($query) use ($displayName) {
            if ($displayName != null) $query->where('display_name', 'LIKE', "$displayName%");
        });

        // 担当者ID
        $query->withWhereHas('line.user', function($query) use ($userId) {
            if ($userId != null) $query->whereId($userId);
        });

        $query->orderBy('notice_date_time', 'desc');

        return $query->get();
    }
}