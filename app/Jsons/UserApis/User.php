<?php

namespace App\Jsons\UserApis;

/**
 * User
 * 
 */
class User implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id                ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     */
    public function __construct(
        public readonly int $id,
        public readonly int $serviceProviderId,
        public readonly ?string $accountId,
        public readonly ?string $name,
        public readonly ?string $email
    )
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