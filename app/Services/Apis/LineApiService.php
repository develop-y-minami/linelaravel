<?php

namespace App\Services\Apis;

use App\Repositorys\LineNoticeSettingRepositoryInterface;
use App\Repositorys\LineRepositoryInterface;
use App\Jsons\LineApis\Line;
use App\Jsons\LineApis\LineAccountStatus;
use App\Jsons\LineApis\LineAccountType;
use App\Jsons\LineApis\User;

/**
 * LineApiService
 * 
 */
class LineApiService implements LineApiServiceInterface
{
    /**
     * LineNoticeSettingRepositoryInterface
     * 
     */
    private $lineNoticeSettingRepository;
    /**
     * LineRepositoryInterface
     * 
     */
    private $lineRepository;

    /**
     * __construct
     * 
     * @param LineNoticeSettingRepositoryInterface lineNoticeSettingRepository
     * @param LineRepositoryInterface              lineRepository
     */
    public function __construct(
        LineNoticeSettingRepositoryInterface $lineNoticeSettingRepository,
        LineRepositoryInterface $lineRepository
    )
    {
        $this->lineNoticeSettingRepository = $lineNoticeSettingRepository;
        $this->lineRepository = $lineRepository;
    }

    /**
     * LINE情報を返却
     * 
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    userId              担当者ID
     * @return array LINE情報
     */
    public function getLines(
        $lineAccountTypeId = null,
        $lineAccountStatusId = null,
        $displayName = null,
        $userId = null
    )
    {
        // 返却データ
        $result = array();

        // LINE情報を取得
        $datas = $this->lineRepository->findByconditions($lineAccountTypeId, $lineAccountStatusId, $displayName, $userId);
        foreach ($datas as $data)
        {
            // ユーザー情報を設定
            $user = new User($data->user->id, $data->user->name);
            // LINEアカウント状態を設定
            $lineAccountStatus = new LineAccountStatus($data->lineAccountStatus->id, $data->lineAccountStatus->name);
            // LINEアカウント種別を設定
            $lineAccountType = new LineAccountType($data->lineAccountType->id, $data->lineAccountType->name);
            // LINE情報を設定
            $line = new Line($data->id, $data->display_name, $data->picture_url, $lineAccountStatus, $lineAccountType, $user);

            // 配列に追加
            $result[] = $line;
        }

        return $result;
    }

    /**
     * LINE担当者情報を設定
     * 
     * @param int   id                LINE情報ID
     * @param bool  noticeSetting     LINE通知設定
     * @param array lineNoticeSttings LINE通知種別設定
     * @param int   userId            担当者ID
     */
    public function userSetting($id, $noticeSetting, $lineNoticeSttings, $userId)
    {
        // LINE情報を取得
        $line = $this->lineRepository->findById($id);

        // トランザクション開始
        \DB::beginTransaction();
        try
        {
            // LINE情報を更新
            if ($line->user_id != $userId || $line->line_of_user_notice != $noticeSetting)
            {
                $line->user_id = $userId;
                $line->line_of_user_notice = $noticeSetting;
                $this->lineRepository->save($line);
            }

            // LINE通知設定情報を削除
            $this->lineNoticeSettingRepository->deleteByLineId($id);

            if ($noticeSetting == true)
            {
                // LINE通知設定情報を作成
                $this->lineNoticeSettingRepository->inserts($id, $lineNoticeSttings);
            }

            \DB::commit();
        }
        catch (\Exception $e)
        {
            \DB::rollback();
            throw $e;
        }
    }
}