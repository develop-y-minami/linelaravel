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
     * LINE通知情報を取得
     * 
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    userId              担当者ID
     * @return Collection LINE通知情報
     */
    public function findByconditions(
        $lineAccountTypeId = null,
        $lineAccountStatusId = null,
        $displayName = null,
        $userId = null
    )
    {
        $query = Line::query();

        $query->with([
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
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @return Line LINE情報
     */
    public function create(
        $accountId,
        $displayName,
        $pictureUrl,
        $lineAccountTypeId,
        $lineAccountStatusId
    )
    {
        return Line::create([
            'account_id' => $accountId,
            'display_name' => $displayName,
            'picture_url' => $pictureUrl,
            'line_account_type_id' => $lineAccountTypeId,
            'line_account_status_id' => $lineAccountStatusId
        ]);
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
        $line->save();
        return $line;
    }
}