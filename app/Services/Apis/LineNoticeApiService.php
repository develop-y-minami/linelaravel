<?php

namespace App\Services\Apis;

use App\Repositorys\LineNoticeRepositoryInterface;
use App\Jsons\LineApis\Line;
use App\Jsons\LineApis\LineAccountStatus;
use App\Jsons\LineApis\LineAccountType;
use App\Jsons\LineApis\LineNotice;
use App\Jsons\LineApis\LineNoticeType;
use App\Jsons\LineApis\User;

/**
 * LineNoticeApiService
 * 
 */
class LineNoticeApiService implements LineNoticeApiServiceInterface
{
    /**
     * LineNoticeRepositoryInterface
     * 
     */
    private $lineNoticeRepository;

    /**
     * __construct
     * 
     * @param LineNoticeRepositoryInterface lineNoticeRepository
     */
    public function __construct(LineNoticeRepositoryInterface $lineNoticeRepository)
    {
        $this->lineNoticeRepository = $lineNoticeRepository;
    }

    /**
     * LINE通知情報を返却
     * 
     * @param string noticeDate       通知日
     * @param int    lineNoticeTypeId LINE通知種別
     * @param string displayName      LINE 表示名
     * @param int    userId           担当者ID
     * @return array LINE通知情報
     */
    public function getNotices(
        $noticeDate = null,
        $lineNoticeTypeId = null,
        $displayName = null,
        $userId = null
    )
    {
        // 返却データ
        $result = array();

        // LINE通知情報を取得
        $datas = $this->lineNoticeRepository->findByconditions($noticeDate, $lineNoticeTypeId, $displayName, $userId);
        foreach ($datas as $data)
        {
            // ユーザー情報を設定
            $user = new User($data->line->user->id, $data->line->user->name);
            // LINEアカウント状態を設定
            $lineAccountStatus = new LineAccountStatus($data->line->lineAccountStatus->id, $data->line->lineAccountStatus->name);
            // LINEアカウント種別を設定
            $lineAccountType = new LineAccountType($data->line->lineAccountType->id, $data->line->lineAccountType->name);
            // LINE情報を設定
            $line = new Line($data->line->id, $data->line->display_name, $data->line->picture_url, $lineAccountStatus, $lineAccountType, $user);
            // LINE通知種別を設定
            $lineNoticeType = new LineNoticeType($data->lineNoticeType->id, $data->lineNoticeType->display_name);
            // LINE通知情報を設定
            $lineNotice = new LineNotice($data->id, $data->notice_date_time, $data->content, $lineNoticeType, $line);

            // 配列に追加
            $result[] = $lineNotice;
        }

        return $result;
    }
}