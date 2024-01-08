<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\UserAccountType;

/**
 * UserAccountTypeRepository
 * 
 */
class UserAccountTypeRepository implements UserAccountTypeRepositoryInterface
{
    /**
     * 全担当者アカウント種別情報を取得
     * 
     * @return Collection 担当者アカウント種別情報
     */
    public function getAll()
    {
        return UserAccountType::get();
    }
}