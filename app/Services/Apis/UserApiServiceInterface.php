<?php

namespace App\Services\Apis;

/**
 * UserApiServiceInterface
 * 
 */
interface UserApiServiceInterface
{
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
    public function getUsers($userType = null, $serviceProviderId = null, $userAccountType = null, $accountId = null, $name = null);

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
    public function register($serviceProviderId, $accountId, $name, $email, $password, $userTypeId, $userAccountTypeId);
}