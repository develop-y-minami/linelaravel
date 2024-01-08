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
     * @param string noticeDate        通知日
     * @param int    lineNoticeTypeId  LINE通知種別
     * @param string displayName       LINE 表示名
     * @param int    serviceProviderId サービス提供者ID
     * @param int    userId            担当者ID
     * @return Collection LINE通知情報
     */
    public function findByconditions(
        $noticeDate = null,
        $lineNoticeTypeId = null,
        $displayName = null,
        $serviceProviderId = null,
        $userId = null
    )
    {
        $query = LineNotice::query();

        $query->with([
            'line',
            'line.serviceProvider',
            'line.user',
            'line.lineAccountType',
            'line.lineAccountStatus',
            'lineNoticeType',
        ]);

        // 通知日
        if ($noticeDate != null) $query->whereDate('notice_date_time', $noticeDate);

        // LINE通知種別
        if ($lineNoticeTypeId != null) $query->whereLineNoticeTypeId($lineNoticeTypeId);

        // LINE 表示名
        if ($displayName != null)
        {
            $query->withWhereHas('line', function($query) use ($displayName) { $query->where('display_name', 'LIKE', "$displayName%"); });
        }
        
        // サービス提供者ID
        if ($serviceProviderId != null) 
        {
            $query->withWhereHas('line.serviceProvider', function($query) use ($serviceProviderId) { $query->whereId($serviceProviderId); });
        }

        // 担当者ID
        if ($userId != null) 
        {
            $query->withWhereHas('line.user', function($query) use ($userId) { $query->whereId($userId); });
        }

        $query->orderBy('notice_date_time', 'desc');

        return $query->get();
    }

    /**
     * LINE通知情報を登録
     * 
     * @param string noticeDateTime   通知日時
     * @param int    lineNoticeTypeId LINE通知種別
     * @param int    lineId           LINE情報ID
     * @param string content          内容
     * @param int    lineMessageId    LINEメッセージ情報ID
     * @return LineNotice LINE通知情報
     */
    public function create($noticeDateTime, $lineNoticeTypeId, $lineId, $content, $lineMessageId = 0)
    {
        return LineNotice::create([
            'notice_date_time' => $noticeDateTime,
            'line_notice_type_id' => $lineNoticeTypeId,
            'line_id' => $lineId,
            'content' => $content,
            'line_message_id' => $lineMessageId
        ]);
    }
}