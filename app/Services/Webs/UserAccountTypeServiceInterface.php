<?php

namespace App\Services\Webs;

/**
 * UserAccountTypeServiceInterface
 * 
 */
interface UserAccountTypeServiceInterface
{
    /**
     * 担当者アカウント種別ラジオボタンに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getRadioItems();
    
    /**
     * 担当者アカウント種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems();
}