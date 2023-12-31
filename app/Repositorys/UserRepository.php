<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * UserRepository
 * 
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * 全担当者情報を取得
     * 
     * @return Collection 担当者情報
     */
    public function getAll()
    {
        return User::get();
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
        return User::create([
            'service_provider_id' => $serviceProviderId,
            'account_id' => $accountId,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'user_type_id' => $userTypeId,
            'user_account_type_id' => $userAccountTypeId
        ]);
    }
}