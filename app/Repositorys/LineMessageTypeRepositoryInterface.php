<?php

namespace App\Repositorys;

/**
 * LineMessageTypeRepositoryInterface
 * 
 * LINEメッセージ種別情報
 * 
 */
interface LineMessageTypeRepositoryInterface
{
    /**
     * 名称検索
     * 
     * @param string name 名称
     * @return LineMessageType LINEメッセージ種別情報
     */
    public function findByName($name);
}