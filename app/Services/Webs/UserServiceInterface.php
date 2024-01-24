<?php

namespace App\Services\Webs;

/**
 * UserServiceInterface
 * 
 * 担当者情報
 * 
 */
interface UserServiceInterface
{
    /**
     * 担当者情報を取得
     * 
     * @param int id ID
     * @return User 担当者情報
     */
    public function getUser($id);

    /**
     * 担当者セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems();
}