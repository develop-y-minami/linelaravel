<?php

namespace App\Repositorys;

/**
 * LineMessageRepositoryInterface
 * 
 */
interface LineMessageRepositoryInterface
{
    /**
     * LINEメッセージ情報を登録
     * 
     * @param string type       メッセージタイプ
     * @param string messageId  メッセージID
     * @param string quoteToken メッセージの引用トークン
     * @return LineMessage LINEメッセージ情報
     */
    public function create($type, $messageId, $quoteToken);
}