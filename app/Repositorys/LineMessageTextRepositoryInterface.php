<?php

namespace App\Repositorys;

/**
 * LineMessageTextRepositoryInterface
 * 
 */
interface LineMessageTextRepositoryInterface
{
    /**
     * LINEメッセージ情報を登録
     * 
     * @param int    lineMessageId LINEメッセージ情報ID
     * @param string text          メッセージ
     * @return LineMessageText LINEメッセージテキスト情報
     */
    public function create($lineMessageId, $text);
}