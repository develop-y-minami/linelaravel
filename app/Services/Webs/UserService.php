<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Repositorys\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * UserService
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
            $datas = $this->userRepository->getAll();
        }
        foreach ($datas as $data)
        {
            $result[] = new SelectItem($data->id, $data->name);
        }

        return $result;
    }
}