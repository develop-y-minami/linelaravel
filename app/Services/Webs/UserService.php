<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Objects\UserSelectItem;
use App\Repositorys\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * UserService
 * 
 * 担当者情報
 * 
 */
class UserService implements UserServiceInterface
{
    /**
     * UserRepositoryInterface
     * 
     */
    private $userRepository;

    /**
     * __construct
     * 
     * @param UserRepositoryInterface userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 担当者情報を取得
     * 
     * @param int id ID
     * @return User 担当者情報
     */
    public function getUser($id)
    {
        return $this->userRepository->findById($id);
    }

    /**
     * 担当者セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        // 返却データ
        $result = array();

        // ログイン担当者の種別を取得
        $userType = Auth::user()->user_type_id;

        // 担当者情報を取得し設定
        $datas;
        if ($userType == \UserType::SERVICE_PROVIDER)
        {
            $datas = $this->userRepository->findByServiceProviderId(Auth::user()->service_provider_id);
        }
        else
        {
            // 運用者の場合は全担当者を取得
            $datas = $this->userRepository->findByUserTypeId(\UserType::SERVICE_PROVIDER);
        }
        foreach ($datas as $data)
        {
            $result[] = new UserSelectItem($data->id, $data->name, $data->service_provider_id);
        }

        return $result;
    }
}