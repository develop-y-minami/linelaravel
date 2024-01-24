<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\UserType;

/**
 * UserTypeRepository
 * 
 * 担当者種別情報
 * 
 */
class UserTypeRepository implements UserTypeRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection 担当者種別情報
     */
    public function getAll()
    {
        return UserType::get();
    }
}