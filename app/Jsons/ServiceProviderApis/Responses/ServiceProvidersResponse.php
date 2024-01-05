<?php

namespace App\Jsons\ServiceProviderApis\Responses;

/**
 * ServiceProvidersResponse
 * 
 */
class ServiceProvidersResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param array serviceProviders サービス提供者情報
     */
    public function __construct(public readonly array $serviceProviders)
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