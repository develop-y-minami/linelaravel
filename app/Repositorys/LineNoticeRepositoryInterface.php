<?php

namespace App\Repositorys;

/**
 * LineNoticeRepositoryInterface
 * 
 * LINE通知情報
 * 
 */
interface LineNoticeRepositoryInterface
{
    /**
     * 条件指定検索
     * 
     * @param string noticeDate             通知日
     * @param int    lineNoticeTypeId       LINE通知種別情報ID
     * @param string lineChannelDisplayName LINEプロフィール表示名
     * @param int    serviceProviderId      サービス提供者情報ID
     * @param int    userId                 担当者情報ID
     * @return Collection LINE通知情報
     */
    public function findByconditions($noticeDate = null, $lineNoticeTypeId = null, $lineChannelDisplayName = null, $serviceProviderId = null, $userId = null);

    /**
     * 登録
     * 
     * @param string noticeDateTime   通知日時
     * @param int    lineNoticeTypeId LINE通知種別情報ID
     * @param int    lineId           LINEプロフィール表示名
     * @param string content          通知内容
     * @return LineNotice LINE通知情報
     */
    public function register($noticeDateTime, $lineNoticeTypeId, $lineId, $content);
}