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
     * ユーザー情報を取得
     * 
     * @param int id ID
     * @return User ユーザー情報
     */
    public function findById($id);

    /**
     * ユーザー情報を取得
     * 
     * @param array ids ID
     * @return Collection 担当者情報
     */
    public function findByIds($ids);

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
     * @param int userTypeId 担当者種別
     * @return Collection 担当者情報
     */
    public function findByUserTypeId($userTypeId);

    /**
     * 担当者情報を取得
     * 
     * @param int    userTypeId        担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return Collection 担当者情報
     */
    public function findByconditions($userTypeId = null, $serviceProviderId = null, $userAccountTypeId = null, $accountId = null, $name = null);

    /**
     * 担当者情報を登録
     * 
     * @param int    userTypeId        担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @param string password          パスワード
     * @return User 担当者情報
     */
    public function register($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email, $password);

    /**
     * 担当者情報を更新
     * 
     * @param int    id                担当者情報ID
     * @param int    userTypeId        担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @return int 更新数
     */
    public function update($id, $userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email);

    /**
     * 担当者情報を保存
     * 
     * @param User user 担当者情報
     * @return bool 結果
     */
    public function save($user);

    /**
     * 担当者情報を削除
     * 
     * @param int id 担当者情報ID
     * @return int 削除件数
     */
    public function destroy($id);

    /**
     * 担当者情報を削除
     * 
     * @param array id 担当者情報ID
     * @return int 削除件数
     */
    public function deletes($ids);
}