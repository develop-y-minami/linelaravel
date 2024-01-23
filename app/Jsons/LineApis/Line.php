<?php

namespace App\Jsons\LineApis;

/**
 * Line
 * 
 */
class Line implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int               id                ID
     * @param string            displayName       LINE表示名
     * @param string            pictureUrl        LINEプロフィール画像URL
     * @param LineAccountStatus lineAccountStatus LINEアカウント状態
     * @param LineAccountType   lineAccountType   LINEアカウント種別
     * @param LineUser          lineUser          LINEユーザー情報
     * @param ServiceProvider   serviceProvider   サービス提供者情報
     * @param User              user              担当者情報
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $displayName,
        public readonly ?string $pictureUrl,
        public readonly LineAccountStatus $lineAccountStatus,
        public readonly LineAccountType $lineAccountType,
        public readonly LineUser $lineUser,
        public readonly ServiceProvider $serviceProvider,
        public readonly User $user
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