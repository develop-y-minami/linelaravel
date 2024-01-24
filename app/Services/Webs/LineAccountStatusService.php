<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Repositorys\LineAccountStatusRepositoryInterface;

/**
 * LineAccountStatusService
 * 
 * LINEアカウント状態情報
 * 
 */
class LineAccountStatusService implements LineAccountStatusServiceInterface
{
    /**
     * LineAccountStatusRepositoryInterface
     * 
     */
    private $lineAccountStatusRepository;

    /**
     * __construct
     * 
     * @param LineAccountStatusRepositoryInterface lineAccountStatusRepository
     */
    public function __construct(LineAccountStatusRepositoryInterface $lineAccountStatusRepository)
    {
        $this->lineAccountStatusRepository = $lineAccountStatusRepository;
    }

    /**
     * LINEアカウント状態セレクトボックスに設定するデータを返却
     * 
     * @param int lineAccountTypeId LINEアカウント種別
     * @return array 選択項目
     */
    public function getSelectItems($lineAccountTypeId = null)
    {
        // 返却データ
        $result = array();

        // LINEアカウント状態を取得し設定
        $datas;
        if ($lineAccountTypeId == null)
        {
            $datas = $this->lineAccountStatusRepository->getAll();
        }
        else
        {
            $datas = $this->lineAccountStatusRepository->findByLineAccountTypeId($lineAccountTypeId);
        }
        foreach ($datas as $data)
        {
            $result[] = new SelectItem($data->id, $data->name);
        }

        return $result;
    }
}