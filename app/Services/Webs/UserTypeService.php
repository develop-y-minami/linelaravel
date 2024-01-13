<?php

namespace App\Services\Webs;

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
     * 担当者種別ラジオボタンに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getRadioItems()
    {
        return \ViewFacade::getRadioItems($this->userTypeRepository->getAll());
    }

    /**
     * 担当者種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        return \ViewFacade::getSelectItems($this->userTypeRepository->getAll());
    }
}