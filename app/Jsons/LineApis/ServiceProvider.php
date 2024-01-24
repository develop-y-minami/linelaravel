<?php

namespace App\Jsons\LineApis;

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
     * @param int    id   ID
     * @param string name 名前
     */
    public function __construct(public readonly ?int $id, public readonly ?string $name)
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