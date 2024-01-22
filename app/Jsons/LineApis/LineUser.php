<?php

namespace App\Jsons\LineApis;

/**
 * LineUser
 * 
 */
class LineUser implements \JsonSerializable
{
    /**
     * __construct
     * 
     * @param int    id        ID
     * @param string accountId アカウントID
     */
    public function __construct(public readonly ?int $id, public readonly ?string $accountId)
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