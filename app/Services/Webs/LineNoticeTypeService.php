<?php

namespace App\Services\Webs;

use App\Objects\CheckListItem;
use App\Objects\SelectItem;
use App\Repositorys\LineNoticeSettingRepositoryInterface;
use App\Repositorys\LineNoticeTypeRepositoryInterface;

/**
 * LineNoticeTypeService
 * 
 */
class LineNoticeTypeService implements LineNoticeTypeServiceInterface
{
    /**
     * LineNoticeSettingRepositoryInterface
     * 
     */
    private $lineNoticeSettingRepository;
    /**
     * LineNoticeTypeRepositoryInterface
     * 
     */
    private $lineNoticeTypeRepository;

    /**
     * __construct
     * 
     * @param LineNoticeSettingRepositoryInterface lineNoticeSettingRepository
     * @param LineNoticeTypeRepositoryInterface lineNoticeTypeRepository
     */
    public function __construct(
        LineNoticeSettingRepositoryInterface $lineNoticeSettingRepository,
        LineNoticeTypeRepositoryInterface $lineNoticeTypeRepository
    )
    {
        $this->lineNoticeSettingRepository = $lineNoticeSettingRepository;
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

        // LINE通知設定情報を取得
        $lineNoticeSettings = $this->lineNoticeSettingRepository->findByLineId($lineId);

        // LINE通知種別を取得
        $datas = $this->lineNoticeTypeRepository->getAll();
        foreach ($datas as $data)
        {
            // チェック状態を設定
            $checked = false;
            foreach ($lineNoticeSettings as $lineNoticeSetting)
            {
                if ($data->id == $lineNoticeSetting->line_notice_type_id)
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