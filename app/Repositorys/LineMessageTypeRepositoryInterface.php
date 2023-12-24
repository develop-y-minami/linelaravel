<?php

namespace App\Repositorys;

/**
 * LineMessageTypeRepositoryInterface
 * 
 */
interface LineMessageTypeRepositoryInterface
{
    /**
     * LINEメッセージ種別を取得
     * 
     * @param string name LINEメッセージ種別名
     * @return LineMessageType LINEメッセージ種別
     */
    public function findByName($name);
}