<?php

namespace App\Facades;

use App\Objects\RadioItem;
use App\Objects\SelectItem;

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

    /**
     * ラジオボタン表示データを返却
     * 
     * @param Collection datas
     * @return array 表示データ
     */
    public static function getRadioItems($datas)
    {
        // 返却データ
        $result = array();

        foreach ($datas as $data)
        {
            $result[] = new RadioItem($data->id, $data->name);
        }

        return $result;
    }

    /**
     * ラジオボタン表示データを返却
     * 
     * @param Collection datas
     * @return array 表示データ
     */
    public static function getSelectItems($datas)
    {
        // 返却データ
        $result = array();

        foreach ($datas as $data)
        {
            $result[] = new SelectItem($data->id, $data->name);
        }

        return $result;
    }
}