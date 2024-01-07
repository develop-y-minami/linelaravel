<?php

namespace App\Jsons\ServiceProviderApis\Responses;

use App\Jsons\ServiceProviderApis\ServiceProvider;

/**
 * ServiceProviderUpdateResponse
 * 
 */
class ServiceProviderUpdateResponse implements \JsonSerializable
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