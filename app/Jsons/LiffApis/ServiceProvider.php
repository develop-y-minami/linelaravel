<?php

namespace App\Jsons\LiffApis;

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
     * @param int    id         ID
     * @param string providerId 提供者ID
     * @param string name       提供者名
     */
    public function __construct(public readonly ?int $id, public readonly ?string $providerId, public readonly ?string $name)
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