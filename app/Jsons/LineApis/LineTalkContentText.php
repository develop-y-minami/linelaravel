<?php

namespace App\Jsons\LineApis;

/**
 * LineTalkContentText
 * 
 */
class LineTalkContentText extends LineTalkContent
{
    /**
     * __construct
     * 
     * @param int 　 messageType メッセージ形式
     * @param string message メッセージ
     */
    public function __construct($messageType, public readonly ?string $message)
    {
        parent::__construct($messageType);
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