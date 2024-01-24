<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineAccountStatus;

/**
 * LineAccountStatusRepository
 * 
 * LINEアカウント状態情報
 * 
 */
class LineAccountStatusRepository implements LineAccountStatusRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection LINEアカウント状態情報
     */
    public function getAll()
    {
        return LineAccountStatus::get();
    }

    /**
     * LINEアカウント種別情報ID検索
     * 
     * @param int lineAccountTypeId LINEアカウント種別情報ID
     * @return Collection LINEアカウント状態情報
     */
    public function findByLineAccountTypeId($lineAccountTypeId)
    {
        return LineAccountStatus::whereLineAccountTypeId($lineAccountTypeId)->get();
    }
}