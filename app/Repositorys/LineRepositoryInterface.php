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
     * @param string accountId LINEアカウントID
     * @return Collection LINE情報
     */
    public function findByAccountId($accountId);

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
    );

    /**
     * LINEアカウント状態を更新
     * 
     * @param Line line              LINE情報
     * @param int  lineAccountStatus LINEアカウント状態
     * @return Line LINE情報
     */
    public function saveLineAccountStatus($line, $lineAccountStatus);
}