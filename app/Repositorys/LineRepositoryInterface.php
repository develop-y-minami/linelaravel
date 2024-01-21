<?php

namespace App\Repositorys;

/**
 * LineRepositoryInterface
 * 
 */
interface LineRepositoryInterface
{
    /**
     * LINE情報を取得
     * 
     * @param int id ID
     * @return Line LINE情報
     */
    public function findById($id);

    /**
     * LINE情報を取得
     * 
     * @param array ids ID
     * @return Line LINE情報
     */
    public function findByIds($ids);

    /**
     * LINE情報を取得
     * 
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    serviceProviderId   サービス提供者ID
     * @param int    userId              担当者ID
     * @return Collection LINE情報
     */
    public function findByconditions(
        $lineAccountTypeId = null,
        $lineAccountStatusId = null,
        $displayName = null,
        $serviceProviderId = null,
        $userId = null
    );

    /**
     * LINE情報を取得
     * 
     * @param string accountId LINEアカウントID
     * @return Line LINE情報
     */
    public function findByAccountId($accountId);

    /**
     * LINE情報を作成
     * 
     * @param string accountId           LINEアカウントID
     * @param string displayName         LINE表示名
     * @param string pictureUrl          LINEプロフィール画像URL
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @return Line LINE情報
     */
    public function create(
        $accountId,
        $displayName,
        $pictureUrl,
        $lineAccountStatusId,
        $lineAccountTypeId
    );

    /**
     * サービス提供者を更新
     * 
     * @param array  ids                        LINE情報ID
     * @param int    serviceProviderId          サービス提供者ID
     * @param string serviceProviderSettingDate サービス提供者設定日
     * @return int 更新件数
     */
    public function updatesServiceProvider($ids, $serviceProviderId, $serviceProviderSettingDate);

    /**
     * LINE情報を更新
     * 
     * @param Line line LINE情報
     * @return Line LINE情報
     */
    public function save($line);
    
    /**
     * LINEアカウント状態を更新
     * 
     * @param Line line              LINE情報
     * @param int  lineAccountStatus LINEアカウント状態
     * @return Line LINE情報
     */
    public function saveLineAccountStatus($line, $lineAccountStatus);
}