<?php

namespace App\Repositorys;

/**
 * UserRepositoryInterface
 * 
 */
interface UserRepositoryInterface
{
    /**
     * 全担当者情報を取得
     * 
     * @return Collection 担当者情報
     */
    public function getAll();

    /**
     * 担当者情報を取得
     * 
     * @param int serviceProviderId サービス提供者ID
     * @return Collection 担当者情報
     */
    public function findByServiceProviderId($serviceProviderId);

    /**
     * 担当者情報を取得
     * 
     * @param int    userType          担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountType   担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return Collection 担当者情報
     */
    public function findByconditions($userType = null, $serviceProviderId = null, $userAccountType = null, $accountId = null, $name = null);

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