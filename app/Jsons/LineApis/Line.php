<?php

namespace App\Jsons\LineApis;

/**
 * Line
 * 
 * LINE情報
 * 
 */
class Line implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int               id                     ID
     * @param string            lineChannelDisplayName LINEプロフィール表示名
     * @param string            lineChannelPictureUrl  LINEプロフィール画像URL
     * @param LineAccountStatus lineAccountStatus      LINEアカウント状態情報
     * @param LineAccountType   lineAccountType        LINEアカウント種別情報
     * @param LineUser          lineUser               LINEユーザー情報
     * @param ServiceProvider   serviceProvider        サービス提供者情報
     * @param User              user                   担当者情報
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $lineChannelDisplayName,
        public readonly ?string $lineChannelPictureUrl,
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