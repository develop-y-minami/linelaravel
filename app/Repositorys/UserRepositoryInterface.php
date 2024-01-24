<?php

namespace App\Repositorys;

/**
 * UserRepositoryInterface
 * 
 * 担当者情報
 * 
 */
interface UserRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection 担当者情報
     */
    public function getAll();

    /**
     * ID検索
     * 
     * @param int id ID
     * @return User ユーザー情報
     */
    public function findById($id);

    /**
     * 複数ID検索
     * 
     * @param array ids ID
     * @return Collection 担当者情報
     */
    public function findByIds($ids);

    /**
     * サービス提供者情報ID検索
     * 
     * @param int serviceProviderId サービス提供者情報ID
     * @return Collection 担当者情報
     */
    public function findByServiceProviderId($serviceProviderId);

    /**
     * 担当者種別情報ID検索
     * 
     * @param int userTypeId 担当者種別情報ID
     * @return Collection 担当者情報
     */
    public function findByUserTypeId($userTypeId);

    /**
     * 条件指定検索
     * 
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return Collection 担当者情報
     */
    public function findByconditions($userTypeId = null, $serviceProviderId = null, $userAccountTypeId = null, $accountId = null, $name = null);

    /**
     * 登録
     * 
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @param string password          パスワード
     * @return User 担当者情報
     */
    public function register($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email, $password);

    /**
     * 更新
     * 
     * @param int    id                ID
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @return int 更新数
     */
    public function update($id, $userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email);

    /**
     * 保存
     * 
     * @param User user 担当者情報
     * @return bool 結果
     */
    public function save($user);

    /**
     * 削除
     * 
     * @param int id ID
     * @return int 削除件数
     */
    public function destroy($id);

    /**
     * 複数削除
     * 
     * @param array id ID
     * @return int 削除件数
     */
    public function deletes($ids);
}