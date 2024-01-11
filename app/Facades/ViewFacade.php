<?php

namespace App\Facades;

/**
 * ViewFacade
 */
class ViewFacade
{
    /**
     * 要素を非表示に設定
     * 
     * @param bool flg
     */
    public static function hide($flg = true)
    {
        if ($flg)
        {
            return 'style="display:none"';
        }
        else
        {
            return '';
        }
    }
}