<?php

namespace App\Jsons\UserApis;

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
     * @param int    id          ID
     * @param string name        提供者名
     * @param bool   useStopFlg  利用停止フラグ
     * @param string useStopName 利用停止名称
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly bool $useStopFlg,
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