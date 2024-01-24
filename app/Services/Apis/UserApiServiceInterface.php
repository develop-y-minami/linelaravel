<?php

namespace App\Services\Apis;

/**
 * UserApiServiceInterface
 * 
 * 担当者情報
 * 
 */
interface UserApiServiceInterface
{
    /**
     * 担当者情報を取得
     * 
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return array 担当者情報
     */
    public function getUsers($userTypeId = null, $serviceProviderId = null, $userAccountTypeId = null, $accountId = null, $name = null);

    /**
     * 担当者情報を登録
     * 
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @param string password          パスワード
     * @param string profileImage      プロフィール画像
     * @return User 担当者情報
     */
    public function register($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email, $password, $profileImage);

    /**
     * 担当者情報を削除
     * 
     * @param array ids ID
     * @return int 削除件数
     */
    public function deletes($ids);

    /**
     * 担当者情報を更新
     * 
     * @param int    id                ID
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return User 担当者情報
     */
    public function update($id, $userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email);

    /**
     * 担当者情報を削除
     * 
     * @param int id ID
     * @return int 削除件数
     */
    public function destroy($id);
}