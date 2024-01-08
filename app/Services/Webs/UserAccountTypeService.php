<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Repositorys\UserAccountTypeRepositoryInterface;

/**
 * UserAccountTypeService
 * 
 */
class UserAccountTypeService implements UserAccountTypeServiceInterface
{
    /**
     * UserAccountTypeRepositoryInterface
     * 
     */
    private $userAccountTypeRepository;

    /**
     * __construct
     * 
     * @param UserAccountTypeRepositoryInterface userAccountTypeRepository
     */
    public function __construct(UserAccountTypeRepositoryInterface $userAccountTypeRepository)
    {
        $this->userAccountTypeRepository = $userAccountTypeRepository;
    }

    /**
     * 担当者アカウント種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        // 返却データ
        $result = array();

        // 担当者アカウント種別情報を取得し設定
        $datas = $this->userAccountTypeRepository->getAll();
        foreach ($datas as $data)
        {
            $result[] = new SelectItem($data->id, $data->name);
        }

        return $result;
    }
}