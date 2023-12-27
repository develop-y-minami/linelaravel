<?php

namespace App\Jsons\LineApis;

/**
 * LineTalkHistory
 * 
 */
class LineTalkHistory implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param string talkDate        日付
     * @param array  lineTalks       トーク内容一覧
     */
    public function __construct(public readonly string $talkDate, public readonly array $lineTalks)
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