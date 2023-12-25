<?php

namespace App\Jsons\LineApis;

/**
 * LineTalkContentMessage
 * 
 */
class LineTalkContentMessage extends LineTalkContent
{
    /**
     * __construct
     * 
     * @param string message メッセージ
     */
    public function __construct(public readonly ?string $message)
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