<?php

namespace App\Jsons\ServiceProviderApis;

/**
 * ServiceProvider
 * 
 * サービス提供者情報
 * 
 */
class ServiceProvider implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id               ID
     * @param string providerId       提供者ID
     * @param string name             提供者名
     * @param string useStartDate 利用開始日
     * @param string useEndDate   利用終了日
     * @param bool   useStopFlg   利用停止フラグ
     * @param string useStopName  利用停止名称
     * @param string createdAt    登録日時
     * @param string updatedAt    更新日時
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $providerId,
        public readonly ?string $name,
        public readonly ?string $useStartDate,
        public readonly ?string $useEndDate,
        public readonly bool $useStopFlg,
        public readonly ?string $useStopName,
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