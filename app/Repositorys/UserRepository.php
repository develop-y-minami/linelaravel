<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * UserRepository
 * 
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * 全担当者情報を取得
     * 
     * @return Collection 担当者情報
     */
    public function getAll()
    {
        return User::get();
    }
}