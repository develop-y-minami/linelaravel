<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Repositorys\UserTypeRepositoryInterface;

/**
 * UserTypeService
 * 
 */
class UserTypeService implements UserTypeServiceInterface
{
    /**
     * UserTypeRepositoryInterface
     * 
     */
    private $userTypeRepository;

    /**
     * __construct
     * 
     * @param UserTypeRepositoryInterface userTypeRepository
     */
    public function __construct(UserTypeRepositoryInterface $userTypeRepository)
    {
        $this->userTypeRepository = $userTypeRepository;
    }

    /**
     * 担当者種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        // 返却データ
        $result = array();

        // 担当者種別情報を取得し設定
        $datas = $this->userTypeRepository->getAll();
        foreach ($datas as $data)
        {
            $result[] = new SelectItem($data->id, $data->name);
        }

        return $result;
    }
}