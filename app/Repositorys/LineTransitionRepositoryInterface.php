<?php

namespace App\Repositorys;

/**
 * LineTransitionRepositoryInterface
 * 
 */
interface LineTransitionRepositoryInterface
{
    /**
     * LINE数推移情報を取得
     * 
     * @param int    serviceProviderId  サービス提供者情報ID
     * @param string transitionDateFrom 日付：FROM
     * @param string transitionDateTo   日付：TO
     * @return Collection LINE数推移情報
     */
    public function findByServiceProvider($serviceProviderId, $transitionDateFrom = null, $transitionDateTo  = null);
}