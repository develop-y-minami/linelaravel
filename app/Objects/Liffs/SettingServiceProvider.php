<?php

namespace App\Objects\Liffs;

/**
 * SettingServiceProvider
 * 
 * サービス提供者設定ページ
 * 
 */
class SettingServiceProvider
{
    /**
     * __construct
     * 
     * @param int liffPageId LIFFページID
     * @param int lineId     LINE情報ID
     */
    public function __construct(public readonly ?int $liffPageId, public readonly ?int $lineId)
    {
        
    }
}