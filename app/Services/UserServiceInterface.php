<?php

namespace App\Services;

/**
 * UserServiceInterface
 * 
 */
interface UserServiceInterface
{
    /**
     * 担当者セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems();
}