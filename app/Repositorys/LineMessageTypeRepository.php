<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineMessageType;

/**
 * LineMessageTypeRepository
 * 
 */
class LineMessageTypeRepository implements LineMessageTypeRepositoryInterface
{
    /**
     * LINEメッセージ種別を取得
     * 
     * @param string name LINEメッセージ種別名
     * @return LineMessageType LINEメッセージ種別
     */
    public function findByName($name)
    {
        return LineMessageType::whereName($name)->first();
    }
}