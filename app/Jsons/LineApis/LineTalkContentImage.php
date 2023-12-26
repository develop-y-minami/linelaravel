<?php

namespace App\Jsons\LineApis;

/**
 * LineTalkContentImage
 * 
 */
class LineTalkContentImage
{
    /**
     * __construct
     * 
     * @param string image 画像ファイルbase64形式
     */
    public function __construct(public readonly ?string $image)
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