<?php

namespace App\Objects;

/**
 * TopPage
 * 
 */
class TopPage
{
    /**
     * __construct
     * 
     * @param array userSelectItems 担当者セレクトボックス選択項目
     */
    public function __construct(public readonly array $userSelectItems)
    {
        
    }
}