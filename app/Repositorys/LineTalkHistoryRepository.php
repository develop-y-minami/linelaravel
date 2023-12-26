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
     * @param int    id           LINE情報ID
     * @param string dateTimeFrom LINEトーク履歴表示期間：FROM
     * @param string dateTimeTo   LINEトーク履歴表示期間：TO
     * @return Collection LINEトーク履歴情報
     */
    public function findByconditions($id, $dateTimeFrom = null, $dateTimeTo = null)
    {
        $query = LineTalkHistory::query();

        $query->with([
            'lineMessage',
            'lineMessage.lineMessageText',
            'lineMessage.lineMessageImage',
            'lineSendMessage',
            'lineSendMessage.lineSendMessageText',
        ]);

        // LINE情報ID
        $query->whereLineId($id);

        return $query->get();
    }
}