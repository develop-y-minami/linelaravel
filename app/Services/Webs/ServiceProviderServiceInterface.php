<?php

namespace App\Services\Webs;

/**
 * ServiceProviderServiceInterface
 * 
 */
interface ServiceProviderServiceInterface
{
    /**
     * サービス提供者セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems();
}