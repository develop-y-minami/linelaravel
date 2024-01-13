<?php

namespace App\Services\Webs;

/**
 * UserTypeServiceInterface
 * 
 */
interface UserTypeServiceInterface
{
    /**
     * 担当者種別ラジオボタンに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getRadioItems();
    
    /**
     * 担当者種別セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems();
}