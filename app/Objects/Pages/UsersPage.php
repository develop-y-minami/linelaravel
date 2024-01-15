<?php

namespace App\Objects\Pages;

/**
 * UsersPage
 * 
 */
class UsersPage
{
    /**
     * __construct
     * 
     * @param array userTypeSelectItems        担当者種別セレクトボックス選択項目
     * @param array userTypeRadioItems         担当者種別ラジオボタン選択項目
     * @param array serviceProviderSelectItems サービス提供者セレクトボックス選択項目
     * @param array userAccountTypeSelectItems 担当者アカウント種別セレクトボックス選択項目
     * @param array userAccountTypeRadioItems  担当者アカウント種別ラジオボタン選択項目
     */
    public function __construct(
        public readonly array $userTypeSelectItems,
        public readonly array $userTypeRadioItems,
        public readonly array $serviceProviderSelectItems,
        public readonly array $userAccountTypeSelectItems,
        public readonly array $userAccountTypeRadioItems
    )
    {
        
    }
}