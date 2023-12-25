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
     */
    public function __construct()
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