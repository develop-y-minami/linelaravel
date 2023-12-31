<?php

namespace App\Jsons\LineApis;

/**
 * LineTalkContent
 * 
 */
class LineTalkContent implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int messageType メッセージ形式
     */
    public function __construct(public readonly int $messageType)
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