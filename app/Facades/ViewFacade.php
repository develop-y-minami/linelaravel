<?php

namespace App\Facades;

use App\Objects\RadioItem;
use App\Objects\SelectItem;
use Carbon\Carbon;

/**
 * ViewFacade
 * 
 * ビュー共通処理
 * 
 */
class ViewFacade
{
    /**
     * 要素を非表示に設定
     * 
     * @param bool flg
     * @return string 'style="display:none"'
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
     * 要素をチェック状態に設定
     * 
     * @param bool flg
     */
    public static function checked($flg = true)
    {
        if ($flg)
        {
            return 'checked';
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

    /**
     * 日付をyyyy-mm-ddに変換
     * 
     * @param string date 日付
     * @return string 変換後日付
     */
    public static function convertDate($date)
    {
        // 返却データ
        $result = '';

        if ($date != null)
        {
            // Carbonのインスタンスを生成
            $carbon = new Carbon($date);

            $result = $carbon->year.'-';
            $result = $result.sprintf('%02d', $carbon->month).'-';
            $result = $result.sprintf('%02d', $carbon->day);
        }

        return $result;
    }

    /**
     * 日付をyyyy年mm月dd日に変換
     * 
     * @param string date 日付
     * @return string 変換後日付
     */
    public static function convertJpDate($date)
    {
        // 返却データ
        $result = '';

        if ($date != null)
        {
            // Carbonのインスタンスを生成
            $carbon = new Carbon($date);

            $result = $carbon->year.'年';
            $result = $result.sprintf('%02d', $carbon->month).'月';
            $result = $result.sprintf('%02d', $carbon->day).'日';
        }

        return $result;
    }

    /**
     * 日時をyyyy年mm月dd日 hh時mm分ss秒に変換
     * 
     * @param string date 日時
     * @return string 変換後日時
     */
    public static function convertJpDateTime($date)
    {
        // 返却データ
        $result = '';

        if ($date != null)
        {
            // Carbonのインスタンスを生成
            $carbon = new Carbon($date);

            $result = $carbon->year.'年';
            $result = $result.sprintf('%02d', $carbon->month).'月';
            $result = $result.sprintf('%02d', $carbon->day).'日';
            $result = $result.' ';
            $result = $result.sprintf('%02d', $carbon->hour).'時';
            $result = $result.sprintf('%02d', $carbon->minute).'分';
            $result = $result.sprintf('%02d', $carbon->second).'秒';
        }

        return $result;
    }

    /**
     * 日付を年齢に変換
     * 
     * @param string date 日付
     * @return int 年齢
     */
    public static function age($date)
    {
        // 返却データ
        $result = '';

        if ($date != null)
        {
            $result = Carbon::parse($date)->age;
        }

        return $result;
    }
}