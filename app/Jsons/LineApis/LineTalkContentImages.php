<?php

namespace App\Jsons\LineApis;

/**
 * LineTalkContentImages
 * 
 */
class LineTalkContentImages extends LineTalkContent
{
    /**
     * __construct
     * 
     * @param int 　 messageType メッセージ形式
     * @param string images      画像ファイル配列
     */
    public function __construct($messageType, public readonly array $images)
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