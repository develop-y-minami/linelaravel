<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineNoticeType;

/**
 * LineNoticeTypeRepository
 * 
 */
class LineNoticeTypeRepository implements LineNoticeTypeRepositoryInterface
{
    /**
     * LINE通知種別を取得
     * 
     * @return Collection LINE通知種別
     */
    public function getAll()
    {
        return LineNoticeType::get();
    }
}