<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineTransition;

/**
 * LineTransitionRepository
 * 
 */
class LineTransitionRepository implements LineTransitionRepositoryInterface
{
    /**
     * LINE数推移情報を取得
     * 
     * @param int    serviceProviderId  サービス提供者情報ID
     * @param string transitionDateFrom 日付：FROM
     * @param string transitionDateTo   日付：TO
     * @return Collection LINE数推移情報
     */
    public function findByServiceProvider($serviceProviderId, $transitionDateFrom = null, $transitionDateTo  = null)
    {
        $query = LineTransition::query();

        // サービス提供者情報ID
        $query->whereServiceProviderId($serviceProviderId);

        // 担当者ID
        $query->whereNull('user_id');

        // 日付：FROM
        if ($transitionDateFrom != null) $query->where('transition_date', '>=', $transitionDateFrom);

        // 日付：TO
        if ($transitionDateTo != null) $query->where('transition_date', '<=', $transitionDateTo);

        $query->orderBy('transition_date');

        return $query->get();
    }
}