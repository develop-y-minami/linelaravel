<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineAccountStatus;

/**
 * LineAccountStatusRepository
 * 
 */
class LineAccountStatusRepository implements LineAccountStatusRepositoryInterface
{
    /**
     * LINEアカウント状態を取得
     * 
     * @return Collection LINEアカウント状態
     */
    public function getAll()
    {
        return LineAccountStatus::get();
    }

    /**
     * LINEアカウント状態を取得
     * 
     * @param int lineAccountTypeId LINEアカウント種別
     * @return Collection LINEアカウント状態
     */
    public function findByLineAccountTypeId($lineAccountTypeId)
    {
        return LineAccountStatus::whereLineAccountTypeId($lineAccountTypeId)->get();
    }
}