<?php

namespace App\Services\Webs;

/**
 * ServiceProviderServiceInterface
 * 
 */
interface ServiceProviderServiceInterface
{
    /**
     * サービス提供者情報を取得
     * 
     * @param int id サービス提供者ID
     * @return ServiceProvider サービス提供者情報
     */
    public function getServiceProvider($id);

    /**
     * サービス提供者セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems();
}