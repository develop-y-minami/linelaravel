<?php

namespace App\Services\Webs;

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
     * 担当者アカウント種別ラジオボタンに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getRadioItems()
    {
        return \ViewFacade::getRadioItems($this->userAccountTypeRepository->getAll());
    }

    /**
     * 担当者アカウント種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        return \ViewFacade::getSelectItems($this->userAccountTypeRepository->getAll());
    }
}