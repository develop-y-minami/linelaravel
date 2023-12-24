<?php

namespace App\Jsons\LineApis\Responses;

/**
 * TalkHistorysResponse
 * 
 */
class TalkHistorysResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param array lineTalkHistorys LINEトーク履歴
     * 
     */
    public function __construct(public readonly array $lineTalkHistorys)
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