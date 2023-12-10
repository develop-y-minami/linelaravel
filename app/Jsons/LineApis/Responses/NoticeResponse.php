<?php

namespace App\Jsons\LineApis\Responses;

/**
 * NoticeResponse
 * 
 */
class NoticeResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param array lineNotice 通知情報
     * 
     */
    public function __construct(public readonly array $lineNotices)
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