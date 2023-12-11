<?php

namespace App\Services;

use App\Repositorys\LineRepositoryInterface;
use App\Jsons\LineApis\Line;
use App\Jsons\LineApis\LineAccountStatus;
use App\Jsons\LineApis\LineAccountType;
use App\Jsons\LineApis\User;

/**
 * LineService
 * 
 */
class LineService implements LineServiceInterface
{
    /**
     * LineRepositoryInterface
     * 
     */
    private $lineRepository;

    /**
     * __construct
     * 
     * @param LineRepositoryInterface lineRepository
     */
    public function __construct(LineRepositoryInterface $lineRepository)
    {
        $this->lineRepository = $lineRepository;
    }

    /**
     * LINE情報を返却
     * 
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    userId              担当者ID
     * @return array LINE通知情報
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

        // LINE通知情報を取得
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
}