<?php

namespace App\Services\Apis;

use App\Repositorys\UserRepositoryInterface;
use App\Jsons\UserApis\ServiceProvider;
use App\Jsons\UserApis\User;
use App\Jsons\UserApis\UserType;
use App\Jsons\UserApis\UserAccountType;

/**
 * UserApiService
 * 
 */
class UserApiService implements UserApiServiceInterface
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
     * @param int    userType          担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountType   担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return array 担当者情報
     */
    public function getUsers($userType = null, $serviceProviderId = null, $userAccountType = null, $accountId = null, $name = null)
    {
        // 返却データ
        $result = array();

        // サービス提供者情報を取得
        $datas = $this->userRepository->findByconditions($userType, $serviceProviderId, $userAccountType, $accountId, $name);
        foreach ($datas as $data)
        {
            // 担当者種別を設定
            $userType = new UserType($data->userType->id, $data->userType->name);
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider($data->serviceProvider->id, $data->serviceProvider->name);
            // 担当者アカウント種別を設定
            $userAccountType = new UserAccountType($data->userAccountType->id, $data->userAccountType->name);
            // 担当者情報を設定
            $user = new User(
                $data->id,
                $userType,
                $serviceProvider,
                $userAccountType,
                $data->accountId,
                $data->name,
                $data->email
            );

            // 配列に追加
            $result[] = $user;
        }

        return $result;
    }

    /**
     * 担当者情報を登録
     * 
     * @param int    serviceProviderId サービス提供者情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @param string password          パスワード
     * @param int    userTypeId        担当者種別
     * @param int    userAccountTypeId 担当者アカウント種別
     * @return User 担当者情報
     */
    public function register($serviceProviderId, $accountId, $name, $email, $password, $userTypeId, $userAccountTypeId)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // 担当者情報を登録
            $result = $this->userRepository->register($serviceProviderId, $accountId, $name, $email, $password, $userTypeId, $userAccountTypeId);

            // 担当者情報を取得
            $data = $this->userRepository->findById($result->id);

            // 担当者種別を設定
            $userType = new ServiceProvider($data->userType->id, $data->userType->name);
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider($data->serviceProvider->id, $data->serviceProvider->name);
            // 担当者アカウント種別を設定
            $userAccountType = new ServiceProvider($data->userAccountType->id, $data->userAccountType->name);
            // 担当者情報を設定
            $user = new User(
                $data->id,
                $userType,
                $serviceProvider,
                $userAccountType,
                $data->accountId,
                $data->name,
                $data->email
            );

            // コミット
            \DB::commit();

            return $user;   
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }
}