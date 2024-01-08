<?php

namespace App\Objects\Pages;

/**
 * TopPage
 * 
 */
class TopPage
{
    /**
     * __construct
     * 
     * @param string lineNoticeDate             LINE通知日
     * @param array  lineNoticeTypeSelectItems  通知種別セレクトボックス選択項目
     * @param array  serviceProviderSelectItems サービス提供者セレクトボックス選択項目
     * @param array  userSelectItems            担当者セレクトボックス選択項目
     */
    public function __construct(
        public readonly string $lineNoticeDate,
        public readonly array $lineNoticeTypeSelectItems,
        public readonly array $serviceProviderSelectItems,
        public readonly array $userSelectItems
    )
    {
        
    }
}