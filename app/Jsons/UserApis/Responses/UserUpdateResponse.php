<?php

namespace App\Jsons\UserApis\Responses;

use App\Jsons\UserApis\User;

/**
 * UserUpdateResponse
 * 
 * 担当者情報更新レスポンス
 * 
 */
class UserUpdateResponse implements \JsonSerializable
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