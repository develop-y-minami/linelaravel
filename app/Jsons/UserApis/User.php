<?php

namespace App\Jsons\UserApis;

/**
 * User
 * 
 * 担当者情報
 * 
 */
class User implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int             id                   ID
     * @param UserType        userType             担当者種別
     * @param ServiceProvider serviceProvider      サービス提供者情報
     * @param UserAccountType userAccountType      担当者アカウント種別
     * @param string          accountId            アカウントID
     * @param string          name                 名前
     * @param string          email                メールアドレス
     * @param string          profileImageFilePath プロフィール画像ファイルパス
     * @param string          createdAt            登録日時
     * @param string          updatedAt            更新日時
     */
    public function __construct(
        public readonly int $id,
        public readonly UserType $userType,
        public readonly ServiceProvider $serviceProvider,
        public readonly UserAccountType $userAccountType,
        public readonly ?string $accountId,
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $profileImageFilePath,
        public readonly ?string $createdAt,
        public readonly ?string $updatedAt
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