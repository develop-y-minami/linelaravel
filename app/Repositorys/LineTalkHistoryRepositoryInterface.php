<?php

namespace App\Repositorys;

/**
 * LineTalkHistoryRepositoryInterface
 * 
 */
interface LineTalkHistoryRepositoryInterface
{
    /**
     * LINEトーク履歴情報を取得
     * 
     * @param int id                  LINE情報ID
     * @param int lineTalkHistoryTerm LINEトーク履歴表示期間
     * @return Collection LINEトーク履歴情報
     */
    public function findByconditions($id, $lineTalkHistoryTerm = null);
}