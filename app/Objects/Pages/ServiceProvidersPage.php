<?php

namespace App\Objects\Pages;

/**
 * ServiceProvidersPage
 * 
 */
class ServiceProvidersPage
{
    /**
     * __construct
     * 
     * @param array userTypeRadioItems         担当者種別ラジオボタン選択項目
     * @param array serviceProviderSelectItems サービス提供者セレクトボックス選択項目
     * @param array userAccountTypeRadioItems  担当者アカウント種別ラジオボタン選択項目
     */
    public function __construct(
        public readonly array $userTypeRadioItems,
        public readonly array $serviceProviderSelectItems,
        public readonly array $userAccountTypeRadioItems
    )
    {
        
    }
}