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
     * @param int    id           LINE情報ID
     * @param string dateTimeFrom LINEトーク履歴表示期間：FROM
     * @param string dateTimeTo   LINEトーク履歴表示期間：TO
     * @return Collection LINEトーク履歴情報
     */
    public function findByconditions($id, $dateTimeFrom = null, $dateTimeTo = null);
}