<?php

namespace App\Repositorys;

/**
 * LineRepositoryInterface
 * 
 */
interface LineRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @param int id ID
     * @return Line LINE情報
     */
    public function findById($id);

    /**
     * 複数ID検索
     * 
     * @param array ids ID
     * @return Line LINE情報
     */
    public function findByIds($ids);

    /**
     * LINEグループID検索
     * 
     * @param string lineChannelGroupId LINEグループID
     * @return Line LINE情報
     */
    public function findByLineChannelGroupId($lineChannelGroupId);

    /**
     * LINEユーザーID,LINEアカウント種別情報ID検索
     * 
     * @param string lineChannelUserId LINEユーザーID
     * @param int    lineAccountTypeId LINEアカウント種別情報ID
     * @return Line LINE情報
     */
    public function findByLineChannelUserIdAndLineAccountTypeId($lineChannelUserId, $lineAccountTypeId);

    /**
     * LINEグループID,LINEアカウント種別情報ID検索
     * 
     * @param string lineChannelGroupId LINEグループID
     * @param int    lineAccountTypeId  LINEアカウント種別情報ID
     * @return Line LINE情報
     */
    public function findByLineChannelGroupIdAndLineAccountTypeId($lineChannelGroupId, $lineAccountTypeId);

    /**
     * LINEグループID、ユーザーID,LINEアカウント種別情報ID検索
     * 
     * @param string lineChannelGroupId LINEグループID
     * @param string lineChannelUserId  LINEユーザーID
     * @param int    lineAccountTypeId  LINEアカウント種別情報ID
     * @return Line LINE情報
     */
    public function findByLineChannelGroupIdAndUserIdAndLineAccountTypeId($lineChannelGroupId, $lineChannelUserId, $lineAccountTypeId);

    /**
     * 条件指定検索
     * 
     * @param int    lineAccountTypeId      LINEアカウント種別情報ID
     * @param int    lineAccountStatusId    LINEアカウント状態情報ID
     * @param string lineChannelDisplayName LINEプロフィール表示名
     * @param int    serviceProviderId      サービス提供者情報ID
     * @param int    userId                 担当者情報ID
     * @return Collection LINE情報
     */
    public function findByconditions($lineAccountTypeId = null, $lineAccountStatusId = null, $lineChannelDisplayName = null, $serviceProviderId = null, $userId = null);

    /**
     * 登録
     * 
     * @param string lineChannelGroupId     LINEグループID
     * @param string lineChannelUserId      LINEユーザーID
     * @param string lineChannelDisplayName LINEプロフィール表示名
     * @param string lineChannelPictureUrl  LINEプロフィール画像URL
     * @param int    lineAccountStatusId    LINEアカウント状態情報ID
     * @param int    lineAccountTypeId      LINEアカウント種別情報ID
     * @param int    lineId                 親LINE情報ID
     * @return Line LINE情報
     */
    public function register($lineChannelGroupId, $lineChannelUserId, $lineChannelDisplayName, $lineChannelPictureUrl, $lineAccountStatusId, $lineAccountTypeId, $lineId = null);

    /**
     * サービス提供者情報更新
     * 
     * @param int    id                         ID
     * @param int    serviceProviderId          サービス提供者情報ID
     * @param string serviceProviderSettingDate サービス提供者設定日
     * @return int 更新件数
     */
    public function updateServiceProvider($id, $serviceProviderId, $serviceProviderSettingDate);

    /**
     * サービス提供者情報複数更新
     * 
     * @param array  ids                        ID
     * @param int    serviceProviderId          サービス提供者情報ID
     * @param string serviceProviderSettingDate サービス提供者設定日
     * @return int 更新件数
     */
    public function updatesServiceProvider($ids, $serviceProviderId, $serviceProviderSettingDate);

    /**
     * 保存
     * 
     * @param Line line LINE情報
     * @return Line LINE情報
     */
    public function save($line);
    
    /**
     * LINEアカウント状態情報を保存
     * 
     * @param Line line                LINE情報
     * @param int  lineAccountStatusId LINEアカウント状態情報ID
     * @return Line LINE情報
     */
    public function saveLineAccountStatus($line, $lineAccountStatusId);
}