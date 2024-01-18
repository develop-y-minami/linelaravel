<?php

namespace App\Objects\Pages;

use App\Models\ServiceProvider;

/**
 * ServiceProviderPage
 * 
 */
class ServiceProviderPage
{
    /**
     * __construct
     * 
     * @param array ServiceProvider            サービス提供者情報
     * @param array userTypeRadioItems         担当者種別ラジオボタン選択項目
     * @param array serviceProviderSelectItems サービス提供者セレクトボックス選択項目
     * @param array userAccountTypeRadioItems  担当者アカウント種別ラジオボタン選択項目
     * @param array userSelectItems            担当者セレクトボックス選択項目
     */
    public function __construct(
        public readonly ServiceProvider $serviceProvider,
        public readonly array $userTypeRadioItems,
        public readonly array $serviceProviderSelectItems,
        public readonly array $userAccountTypeRadioItems,
        public readonly array $userSelectItems
    )
    {
        
    }
}