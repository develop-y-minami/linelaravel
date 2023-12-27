<?php

namespace App\Services\Webs;

use App\Objects\CheckListItem;
use App\Objects\SelectItem;
use App\Repositorys\LineOfUserNoticeSettingRepositoryInterface;
use App\Repositorys\LineNoticeTypeRepositoryInterface;

/**
 * LineNoticeTypeService
 * 
 */
class LineNoticeTypeService implements LineNoticeTypeServiceInterface
{
    /**
     * LineOfUserNoticeSettingRepositoryInterface
     * 
     */
    private $lineOfUserNoticeSettingRepository;
    /**
     * LineNoticeTypeRepositoryInterface
     * 
     */
    private $lineNoticeTypeRepository;

    /**
     * __construct
     * 
     * @param LineOfUserNoticeSettingRepositoryInterface lineOfUserNoticeSettingRepository
     * @param LineNoticeTypeRepositoryInterface          lineNoticeTypeRepository
     */
    public function __construct(
        LineOfUserNoticeSettingRepositoryInterface $lineOfUserNoticeSettingRepository,
        LineNoticeTypeRepositoryInterface $lineNoticeTypeRepository
    )
    {
        $this->lineOfUserNoticeSettingRepository = $lineOfUserNoticeSettingRepository;
        $this->lineNoticeTypeRepository = $lineNoticeTypeRepository;
    }

    /**
     * LINE通知種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        // 返却データ
        $result = array();

        // LINE通知種別を取得し設定
        $datas = $this->lineNoticeTypeRepository->getAll();
        foreach ($datas as $data)
        {
            $result[] = new SelectItem($data->id, $data->display_name);
        }

        return $result;
    }

    /**
     * LINE通知種別チェックリストに設定するデータを返却
     * 
     * @param int lineId LINE情報ID
     * @return array 選択項目
     */
    public function getCheckListItems($lineId)
    {
        // 返却データ
        $result = array();

        // LINE担当者通知設定情報を取得
        $lineOfUserNoticeSettings = $this->lineOfUserNoticeSettingRepository->findByLineId($lineId);

        // LINE通知種別を取得
        $datas = $this->lineNoticeTypeRepository->getAll();
        foreach ($datas as $data)
        {
            // チェック状態を設定
            $checked = false;
            foreach ($lineOfUserNoticeSettings as $lineOfUserNoticeSetting)
            {
                if ($data->id == $lineOfUserNoticeSetting->line_notice_type_id)
                {
                    $checked = true;
                    break;
                }
            }

            $result[] = new CheckListItem($data->id, $data->display_name, $checked);
        }

        return $result;
    }
}