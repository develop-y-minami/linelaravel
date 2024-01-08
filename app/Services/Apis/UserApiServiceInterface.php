<?php

namespace App\Services\Apis;

/**
 * UserApiServiceInterface
 * 
 */
interface UserApiServiceInterface
{
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
    public function register($serviceProviderId, $accountId, $name, $email, $password, $userTypeId, $userAccountTypeId);
}