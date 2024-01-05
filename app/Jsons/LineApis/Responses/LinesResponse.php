<?php

namespace App\Jsons\LineApis\Responses;

/**
 * LinesResponse
 * 
 */
class LinesResponse implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param array lines LINE情報
     */
    public function __construct(public readonly array $lines)
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