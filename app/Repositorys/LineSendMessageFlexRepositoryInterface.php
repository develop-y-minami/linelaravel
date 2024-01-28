<?php

namespace App\Repositorys;

/**
 * LineSendMessageFlexRepositoryInterface
 * 
 * LINE送信メッセージFlex情報
 * 
 */
interface LineSendMessageFlexRepositoryInterface
{
    /**
     * 登録
     * 
     * @param int    lineSendMessageId LINE送信メッセージ情報ID
     * @param int    liffPageTypeId    LIFFページ種別情報ID
     * @param string altText           通知テキスト
     * @param string content           Flexコンテンツ
     * @return LineSendMessageFlex LINE送信メッセージFlex情報
     */
    public function register($lineSendMessageId, $liffPageTypeId, $altText, $content);
}