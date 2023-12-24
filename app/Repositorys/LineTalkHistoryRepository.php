<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineTalkHistory;

/**
 * LineTalkHistoryRepository
 * 
 */
class LineTalkHistoryRepository implements LineTalkHistoryRepositoryInterface
{
    /**
     * LINEトーク履歴情報を取得
     * 
     * @param int id                  LINE情報ID
     * @param int lineTalkHistoryTerm LINEトーク履歴表示期間
     * @return Collection LINEトーク履歴情報
     */
    public function findByconditions($id, $lineTalkHistoryTerm = null)
    {
        $query = LineTalkHistory::query();

        // LINE情報ID
        $query->whereLineId($id);

        return $query->get();
    }
}