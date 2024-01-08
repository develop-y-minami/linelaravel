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
     * LINE情報を取得
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
    )
    {
        $query = Line::query();

        $query->with([
            'serviceProvider',
            'user',
            'lineAccountType',
            'lineAccountStatus'
        ]);

        // LINEアカウント種別
        if ($lineAccountTypeId !== null) $query->whereLineAccountTypeId($lineAccountTypeId);

        // LINEアカウント状態
        if ($lineAccountStatusId !== null) $query->whereLineAccountStatusId($lineAccountStatusId);

        // LINE 表示名
        if ($displayName != null) $query->where('display_name', 'LIKE', "$displayName%");

        // サービス提供者ID
        if ($serviceProviderId != null) $query->whereServiceProviderId($serviceProviderId);

        // 担当者ID
        if ($userId != null) $query->whereUserId($userId);

        $query->orderBy('created_at', 'desc');

        return $query->get();
    }

    /**
     * LINE情報を取得
     * 
     * @param string accountId LINEアカウントID
     * @return Line LINE情報
     */
    public function findByAccountId($accountId)
    {
        return Line::whereAccountId($accountId)->first();
    }

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
    )
    {
        return Line::create([
            'account_id' => $accountId,
            'display_name' => $displayName,
            'picture_url' => $pictureUrl,
            'line_account_status_id' => $lineAccountStatusId,
            'line_account_type_id' => $lineAccountTypeId,
        ]);
    }

    /**
     * LINE情報を更新
     * 
     * @param Line line LINE情報
     * @return Line LINE情報
     */
    public function save($line) {
        $line->save();
        return $line;
    }

    /**
     * LINEアカウント状態を更新
     * 
     * @param Line line              LINE情報
     * @param int  lineAccountStatus LINEアカウント状態
     * @return Line LINE情報
     */
    public function saveLineAccountStatus($line, $lineAccountStatus)
    {
        $line->line_account_status_id = $lineAccountStatus;
        return $this->save($line);
    }
}