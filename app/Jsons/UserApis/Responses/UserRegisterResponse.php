<?php

namespace App\Jsons\UserApis\Responses;

use App\Jsons\UserApis\User;

/**
 * UserRegisterResponse
 * 
 */
class UserRegisterResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param User user ユーザー情報
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