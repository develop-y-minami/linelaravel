<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\UserAccountType;

/**
 * UserAccountTypeRepository
 * 
 * 担当者アカウント種別情報
 * 
 */
class UserAccountTypeRepository implements UserAccountTypeRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection 担当者アカウント種別情報
     */
    public function getAll()
    {
        return UserAccountType::get();
    }
}