<?php

namespace App\Repositorys;

/**
 * UserTypeRepositoryInterface
 * 
 * 担当者種別情報
 * 
 */
interface UserTypeRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection 担当者種別情報
     */
    public function getAll();
}