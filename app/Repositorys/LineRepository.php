<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\Line;

/**
 * LineRepository
 * 
 */
class LineRepository implements LineRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @param int id ID
     * @return Line LINE情報
     */
    public function findById($id)
    {
        return Line::with([
            'serviceProvider',
            'user',
            'lineAccountType',
            'lineAccountStatus',
            'lineUser',
            'lineUser.personality',
            'lineUser.prefecture',
            'lineUser.lineUserCorporate',
            'lineUser.lineUserIndividual',
            'lineUser.lineUserIndividual.gender'
        ])->find($id);
    }

    /**
     * 複数ID検索
     * 
     * @param array ids ID
     * @return Line LINE情報
     */
    public function findByIds($ids)
    {
        return Line::with([
            'serviceProvider',
            'user',
            'lineAccountType',
            'lineAccountStatus',
            'lineUser'
        ])->whereIn('id', $ids)->get();
    }

    /**
     * LINEユーザーID検索
     * 
     * @param string lineChannelUserId LINEユーザーID
     * @param int    lineAccountTypeId LINEアカウント種別情報ID
     * @return Line LINE情報
     */
    public function findByLineChannelUserId($lineChannelUserId, $lineAccountTypeId)
    {
        $query = Line::query();

        // LINEユーザーID
        $query->whereLineChannelUserId($lineChannelUserId);

        // LINEアカウント種別情報ID
        $query->whereLineAccountTypeId($lineAccountTypeId);

        return $query->first();
    }

    /**
     * LINEグループID検索
     * 
     * @param string lineChannelGroupId LINEグループID
     * @param int    lineAccountTypeId  LINEアカウント種別情報ID
     * @return Line LINE情報
     */
    public function findByLineChannelGroupId($lineChannelGroupId, $lineAccountTypeId)
    {
        $query = Line::query();

        // LINEグループID
        $query->whereLineChannelGroupId($lineChannelGroupId);

        // LINEアカウント種別情報ID
        $query->whereLineAccountTypeId($lineAccountTypeId);

        return $query->first();
    }

    /**
     * LINEグループID、ユーザーID検索
     * 
     * @param string lineChannelGroupId LINEグループID
     * @param string lineChannelUserId  LINEユーザーID
     * @param int    lineAccountTypeId  LINEアカウント種別情報ID
     * @return Line LINE情報
     */
    public function findByLineChannelGroupIdAndUserId($lineChannelGroupId, $lineChannelUserId, $lineAccountTypeId)
    {
        $query = Line::query();

        // LINEグループID
        $query->whereLineChannelGroupId($lineChannelGroupId);

        // LINEユーザーID
        $query->whereLineChannelUserId($lineChannelUserId);

        // LINEアカウント種別情報ID
        $query->whereLineAccountTypeId($lineAccountTypeId);

        return $query->first();
    }

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
    public function findByconditions($lineAccountTypeId = null, $lineAccountStatusId = null, $lineChannelDisplayName = null, $serviceProviderId = null, $userId = null)
    {
        $query = Line::query();

        $query->with([
            'serviceProvider',
            'user',
            'lineAccountType',
            'lineAccountStatus',
            'lineUser'
        ]);

        // LINEアカウント種別
        if ($lineAccountTypeId !== null) $query->whereLineAccountTypeId($lineAccountTypeId);

        // LINEアカウント状態
        if ($lineAccountStatusId !== null) $query->whereLineAccountStatusId($lineAccountStatusId);

        // LINEプロフィール表示名
        if ($lineChannelDisplayName != null) $query->where('line_channel_display_name', 'LIKE', "$lineChannelDisplayName%");

        // サービス提供者情報ID
        if ($serviceProviderId != null) $query->whereServiceProviderId($serviceProviderId);

        // 担当者情報ID
        if ($userId != null) $query->whereUserId($userId);

        $query->orderBy('service_provider_id')
        ->orderBy('user_id')
        ->orderBy('line_account_type_id')
        ->orderBy('line_account_status_id')
        ->orderBy('line_channel_display_name');

        return $query->get();
    }

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
    public function register($lineChannelGroupId, $lineChannelUserId, $lineChannelDisplayName, $lineChannelPictureUrl, $lineAccountStatusId, $lineAccountTypeId, $lineId = null)
    {
        return Line::create([
            'line_channel_group_id' => $lineChannelGroupId,
            'line_channel_user_id' => $lineChannelUserId,
            'line_channel_display_name' => $lineChannelDisplayName,
            'line_channel_picture_url' => $lineChannelPictureUrl,
            'line_account_status_id' => $lineAccountStatusId,
            'line_account_type_id' => $lineAccountTypeId,
            'line_id' => $lineId
        ]);
    }

    /**
     * サービス提供者情報複数更新
     * 
     * @param array  ids                        ID
     * @param int    serviceProviderId          サービス提供者情報ID
     * @param string serviceProviderSettingDate サービス提供者設定日
     * @return int 更新件数
     */
    public function updatesServiceProvider($ids, $serviceProviderId, $serviceProviderSettingDate)
    {
        return Line::whereIn('id', $ids)->update([
            'service_provider_id' => $serviceProviderId,
            'service_provider_setting_date' => $serviceProviderSettingDate,
            'user_id' => null,
            'user_setting_date' => null
        ]);
    }

    /**
     * 保存
     * 
     * @param Line line LINE情報
     * @return Line LINE情報
     */
    public function save($line)
    {
        $line->save();
        return $line;
    }

    /**
     * LINEアカウント状態情報を保存
     * 
     * @param Line line                LINE情報
     * @param int  lineAccountStatusId LINEアカウント状態情報ID
     * @return Line LINE情報
     */
    public function saveLineAccountStatus($line, $lineAccountStatusId)
    {
        $line->line_account_status_id = $lineAccountStatusId;
        return $this->save($line);
    }
}