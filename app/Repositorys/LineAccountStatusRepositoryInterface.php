<?php

namespace App\Repositorys;

/**
 * LineAccountStatusRepositoryInterface
 * 
 * LINEアカウント状態情報
 * 
 */
interface LineAccountStatusRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection LINEアカウント状態情報
     */
    public function getAll();

    /**
     * LINEアカウント種別情報ID検索
     * 
     * @param int lineAccountTypeId LINEアカウント種別情報ID
     * @return Collection LINEアカウント状態情報
     */
    public function findByLineAccountTypeId($lineAccountTypeId);
}