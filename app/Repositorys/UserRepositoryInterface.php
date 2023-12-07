<?php

namespace App\Repositorys;

/**
 * UserRepositoryInterface
 * 
 */
interface UserRepositoryInterface
{
    /**
     * 全担当者情報を取得
     * 
     * @return Collection 担当者情報
     */
    public function getAll();
}