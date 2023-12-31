<?php

namespace App\Objects\Pages;

/**
 * UserPage
 * 
 */
class UserPage
{
    /**
     * __construct
     * 
     * @param array  userTypeSelectItems        担当者種別セレクトボックス選択項目
     * @param array  serviceProviderSelectItems サービス提供者セレクトボックス選択項目
     * @param array  userAccountTypeSelectItems 担当者アカウント種別セレクトボックス選択項目
     */
    public function __construct(
        public readonly array $userTypeSelectItems,
        public readonly array $serviceProviderSelectItems,
        public readonly array $userAccountTypeSelectItems
    )
    {
        
    }
}