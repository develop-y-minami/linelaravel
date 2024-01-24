<?php

namespace App\Jsons\UserApis\Responses;

use App\Jsons\UserApis\User;

/**
 * UserRegisterResponse
 * 
 * 担当者情報登録レスポンス
 * 
 */
class UserRegisterResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param User user 担当者情報
     */
    public function __construct(public readonly User $user)
    {

    }

    /**
     * jsonSerialize
     * 
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}