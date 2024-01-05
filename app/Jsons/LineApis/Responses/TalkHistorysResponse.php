<?php

namespace App\Jsons\LineApis\Responses;

use App\Jsons\LineApis\Line;

/**
 * TalkHistorysResponse
 * 
 */
class TalkHistorysResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param Line  line             LINE情報
     * @param array lineTalkHistorys LINEトーク履歴
     */
    public function __construct(public readonly Line $line, public readonly array $lineTalkHistorys)
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