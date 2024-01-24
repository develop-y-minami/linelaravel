<?php

namespace App\Facades;

/**
 * StringFacade
 * 
 * 文字列共通処理
 * 
 */
class StringFacade
{
    /**
     * 住所を取得
     * 
     * @param string prefectureName 都道府県名
     * @param string municipalitie  市町村
     * @param string house_number   番地
     * @param string building       建物名
     * @return string 住所
     */
    public static function getAddress($prefectureName, $municipalitie, $houseNumber, $building)
    {
        $result = '';
        if ($prefectureName != null) $result.= $prefectureName;
        if ($municipalitie != null) $result.= $municipalitie;
        if ($houseNumber != null) $result.= $houseNumber;
        if ($building != null) $result.= $building;
        return $result;
    }
}