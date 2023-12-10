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
     * @param string accountId LINEアカウントID
     * @return Collection LINE情報
     */
    public function findByAccountId($accountId)
    {
        return Line::whereAccountId($accountId)->get();
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