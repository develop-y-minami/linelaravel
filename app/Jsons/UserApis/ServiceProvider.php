<?php

namespace App\Jsons\UserApis;

/**
 * ServiceProvider
 * 
 */
class ServiceProvider implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id          ID
     * @param string name        名前
     * @param bool   useStop     サービス利用状態
     * @param string useStopName サービス利用状態名称
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly bool $useStop,
        public readonly ?string $useStopName
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