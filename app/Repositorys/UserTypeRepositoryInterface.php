<?php

namespace App\Repositorys;

/**
 * UserTypeRepositoryInterface
 * 
 */
interface UserTypeRepositoryInterface
{
    /**
     * 全担当者種別情報を取得
     * 
     * @return Collection 担当者種別情報
     */
    public function getAll();
}