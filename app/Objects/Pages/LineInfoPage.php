<?php

namespace App\Objects\Pages;

use App\Models\Line;

/**
 * LineInfoPage
 * 
 */
class LineInfoPage
{
    /**
     * __construct
     * 
     * @param Line   line            LINE情報
     * @param array  userSelectItems 担当者セレクトボックス選択項目
     */
    public function __construct(
        public readonly Line $line,
        public readonly array $userSelectItems
    )
    {
        
    }
}