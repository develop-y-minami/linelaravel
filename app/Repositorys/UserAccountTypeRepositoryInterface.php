<?php

namespace App\Repositorys;

/**
 * UserAccountTypeRepositoryInterface
 * 
 * 担当者アカウント種別情報
 * 
 */
interface UserAccountTypeRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection 担当者アカウント種別情報
     */
    public function getAll();
}