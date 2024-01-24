<?php

namespace App\Jsons\UserApis\Responses;

/**
 * UsersResponse
 * 
 * 担当者情報取得レスポンス
 * 
 */
class UsersResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param array users 担当者情報
     */
    public function __construct(public readonly array $users)
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