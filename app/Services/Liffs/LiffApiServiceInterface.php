<?php

namespace App\Services\Liffs;

/**
 * LiffApiServiceInterface
 * 
 * LIFF Api
 * 
 */
interface LiffApiServiceInterface
{
    /**
     * サービス提供者情報を取得
     * 提供者ID検索
     * 
     * @param string providerId 提供者ID
     * @return ServiceProvider サービス提供者情報
     */
    public function getServiceProviderFindByProviderId($providerId);
}