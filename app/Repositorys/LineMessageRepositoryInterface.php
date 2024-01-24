<?php

namespace App\Repositorys;

/**
 * LineMessageRepositoryInterface
 * 
 */
interface LineMessageRepositoryInterface
{
    /**
     * 登録
     * 
     * @param int    lineMessageTypeId     LINEメッセージ種別情報ID
     * @param string lineChannelMessageId  LINEメッセージID
     * @param string lineChannelQuoteToken LINEメッセージ引用トークン
     * @param string lineNoticeId          LINE通知情報ID
     * @return LineMessage LINEメッセージ情報
     */
    public function register($lineMessageTypeId, $lineChannelMessageId, $lineChannelQuoteToken, $lineNoticeId);
}