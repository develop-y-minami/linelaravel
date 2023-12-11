<?php

namespace App\Repositorys;

/**
 * LineNoticeTypeRepositoryInterface
 * 
 */
interface LineNoticeTypeRepositoryInterface
{
    /**
     * LINE通知種別を取得
     * 
     * @return Collection LINE通知種別
     */
    public function getAll();

    /**
     * LINE通知種別を取得
     * 
     * @return LineNoticeType LINE通知種別
     */
    public function findByType($type);
}