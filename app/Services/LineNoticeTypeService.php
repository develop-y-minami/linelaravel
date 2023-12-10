<?php

namespace App\Services;

use App\Objects\SelectItem;
use App\Repositorys\LineNoticeTypeRepositoryInterface;

/**
 * LineNoticeTypeService
 * 
 */
class LineNoticeTypeService implements LineNoticeTypeServiceInterface
{
    /**
     * LineNoticeTypeRepositoryInterface
     * 
     */
    private $lineNoticeTypeRepository;

    /**
     * __construct
     * 
     * @param LineNoticeTypeRepositoryInterface lineNoticeTypeRepository
     */
    public function __construct(LineNoticeTypeRepositoryInterface $lineNoticeTypeRepository)
    {
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
}