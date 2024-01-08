<?php

namespace App\Services\Apis;

use App\Repositorys\UserRepositoryInterface;
use App\Jsons\UserApis\User;

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
     * ユーザー情報を登録
     * 
     * @param int    serviceProviderId サービス提供者情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @param string password          パスワード
     * @param int    userTypeId        ユーザー種別
     * @param int    userAccountTypeId ユーザーアカウント種別
     * @return User ユーザー情報
     */
    public function register($serviceProviderId, $accountId, $name, $email, $password, $userTypeId, $userAccountTypeId)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // ユーザー情報を登録
            $data = $this->userRepository->register($serviceProviderId, $accountId, $name, $email, $password, $userTypeId, $userAccountTypeId);
            // ユーザー情報を設定
            $user = new User(
                $data->id,
                $data->service_provider_id,
                $data->account_id,
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