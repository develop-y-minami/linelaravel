<?php

namespace App\Repositorys;

/**
 * UserAccountTypeRepositoryInterface
 * 
 */
interface UserAccountTypeRepositoryInterface
{
    /**
     * 全担当者アカウント種別情報を取得
     * 
     * @return Collection 担当者アカウント種別情報
     */
    public function getAll();
}