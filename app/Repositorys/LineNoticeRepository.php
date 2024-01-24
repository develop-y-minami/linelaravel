<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineNotice;

/**
 * LineNoticeRepository
 * 
 * LINE通知情報
 * 
 */
class LineNoticeRepository implements LineNoticeRepositoryInterface
{
    /**
     * 条件指定検索
     * 
     * @param string noticeDate             通知日
     * @param int    lineNoticeTypeId       LINE通知種別情報ID
     * @param string lineChannelDisplayName LINEプロフィール表示名
     * @param int    serviceProviderId      サービス提供者情報ID
     * @param int    userId                 担当者情報ID
     * @return Collection LINE通知情報
     */
    public function findByconditions($noticeDate = null, $lineNoticeTypeId = null, $lineChannelDisplayName = null, $serviceProviderId = null, $userId = null)
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

        // LINE通知種別情報ID
        if ($lineNoticeTypeId != null) $query->whereLineNoticeTypeId($lineNoticeTypeId);

        // LINEプロフィール表示名
        if ($lineChannelDisplayName != null)
        {
            $query->withWhereHas('line', function($query) use ($lineChannelDisplayName) { $query->where('line_channel_display_name', 'LIKE', "$lineChannelDisplayName%"); });
        }
        
        // サービス提供者情報ID
        if ($serviceProviderId != null) 
        {
            $query->withWhereHas('line.serviceProvider', function($query) use ($serviceProviderId) { $query->whereId($serviceProviderId); });
        }

        // 担当者情報ID
        if ($userId != null) 
        {
            $query->withWhereHas('line.user', function($query) use ($userId) { $query->whereId($userId); });
        }

        $query->orderBy('notice_date_time', 'desc');

        return $query->get();
    }

    /**
     * 登録
     * 
     * @param string noticeDateTime   通知日時
     * @param int    lineNoticeTypeId LINE通知種別情報ID
     * @param int    lineId           LINEプロフィール表示名
     * @param string content          通知内容
     * @return LineNotice LINE通知情報
     */
    public function register($noticeDateTime, $lineNoticeTypeId, $lineId, $content)
    {
        return LineNotice::create([
            'notice_date_time' => $noticeDateTime,
            'line_notice_type_id' => $lineNoticeTypeId,
            'line_id' => $lineId,
            'content' => $content
        ]);
    }
}