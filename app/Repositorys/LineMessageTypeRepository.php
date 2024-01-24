<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineMessageType;

/**
 * LineMessageTypeRepository
 * 
 * LINEメッセージ種別情報
 * 
 */
class LineMessageTypeRepository implements LineMessageTypeRepositoryInterface
{
    /**
     * 名称検索
     * 
     * @param string name 名称
     * @return LineMessageType LINEメッセージ種別情報
     */
    public function findByName($name)
    {
        return LineMessageType::whereName($name)->first();
    }
}