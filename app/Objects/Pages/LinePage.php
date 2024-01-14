<?php

namespace App\Objects\Pages;

use App\Models\Line;

/**
 * LinePage
 * 
 */
class LinePage
{
    /**
     * __construct
     * 
     * @param Line  line                            LINE情報
     * @param array lineNoticeSettingCheckItems     LINE通知設定チェック項目データ
     * @param array lineNoticeUserSettingCheckItems LINE通知担当者設定チェック項目データ
     */
    public function __construct(
        public readonly Line $line,
        public readonly array $lineNoticeSettingCheckItems,
        public readonly array $lineNoticeUserSettingCheckItems
    )
    {
        
    }
}