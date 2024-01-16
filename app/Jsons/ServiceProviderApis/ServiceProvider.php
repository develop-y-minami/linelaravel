<?php

namespace App\Jsons\ServiceProviderApis;

/**
 * ServiceProvider
 * 
 */
class ServiceProvider implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id               ID
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @param string useStopName      サービス利用状態名称
     * @param string createdAt        登録日時
     * @param string updatedAt        更新日時
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $providerId,
        public readonly ?string $name,
        public readonly ?string $useStartDateTime,
        public readonly ?string $useEndDateTime,
        public readonly bool $useStop,
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