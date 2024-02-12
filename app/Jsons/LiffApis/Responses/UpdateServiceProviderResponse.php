<?php

namespace App\Jsons\LiffApis\Responses;

use App\Jsons\LiffApis\ServiceProvider;

/**
 * UpdateServiceProviderResponse
 * 
 * サービス提供者情報更新レスポンス
 * 
 */
class UpdateServiceProviderResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param ServiceProvider serviceProvider サービス提供者情報
     */
    public function __construct(public readonly ServiceProvider $serviceProvider)
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