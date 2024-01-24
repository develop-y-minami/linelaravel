<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineNoticeType;

/**
 * LineNoticeTypeRepository
 * 
 * LINE通知種別情報
 * 
 */
class LineNoticeTypeRepository implements LineNoticeTypeRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection LINE通知種別情報
     */
    public function getAll()
    {
        return LineNoticeType::get();
    }

    /**
     * 種別名検索
     * 
     * @param string 種別名
     * @return LineNoticeType LINE通知種別情報
     */
    public function findByType($type)
    {
        return LineNoticeType::whereType($type)->first();
    }
}