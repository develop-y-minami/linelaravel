<?php

namespace App\Repositorys;

/**
 * LineAccountStatusRepositoryInterface
 * 
 */
interface LineAccountStatusRepositoryInterface
{
    /**
     * LINEアカウント状態を取得
     * 
     * @return Collection LINEアカウント状態
     */
    public function getAll();

    /**
     * LINEアカウント状態を取得
     * 
     * @param int lineAccountTypeId LINEアカウント種別
     * @return Collection LINEアカウント状態
     */
    public function findByLineAccountTypeId($lineAccountTypeId);
}