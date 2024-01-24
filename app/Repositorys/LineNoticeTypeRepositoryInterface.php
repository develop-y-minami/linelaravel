<?php

namespace App\Repositorys;

/**
 * LineNoticeTypeRepositoryInterface
 * 
 * LINE通知種別情報
 * 
 */
interface LineNoticeTypeRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection LINE通知種別情報
     */
    public function getAll();

    /**
     * 種別名検索
     * 
     * @param string 種別名
     * @return LineNoticeType LINE通知種別情報
     */
    public function findByType($type);
}