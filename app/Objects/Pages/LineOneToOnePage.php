<?php

namespace App\Objects\Pages;

/**
 * LineOneToOnePage
 * 
 */
class LineOneToOnePage
{
    /**
     * __construct
     * 
     * @param int    lineAccountTypeId            LINEアカウント種別ID
     * @param array  lineAccountStatusSelectItems LINEアカウント状態セレクトボックス選択項目
     * @param array  userSelectItems              担当者セレクトボックス選択項目
     */
    public function __construct(
        public readonly int $lineAccountTypeId,
        public readonly array $lineAccountStatusSelectItems,
        public readonly array $userSelectItems
    )
    {
        
    }
}