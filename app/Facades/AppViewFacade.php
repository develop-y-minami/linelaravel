<?php

namespace App\Facades;

use Illuminate\Support\Facades\Auth;

/**
 * AppViewFacade
 */
class AppViewFacade
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
    public static function address($prefectureName, $municipalitie, $houseNumber, $building)
    {
        $result = '';
        if ($prefectureName != null) $result.= $prefectureName;
        if ($municipalitie != null) $result.= $municipalitie;
        if ($houseNumber != null) $result.= $houseNumber;
        if ($building != null) $result.= $building;
        return $result;
    }

    /**
     * LINEアカウント状態に対応する色を返却
     * 
     * @param int lineAccountStatus LINEアカウント状態
     * @return string 色
     */
    public static function lineAccountStatusLabelBoxColor($lineAccountStatus)
    {
        $color = '';

        switch ($lineAccountStatus)
        {
            case \LineAccountStatus::FOLLOW:
            case \LineAccountStatus::FOLLOW:
                $color = 'green';
                break;
            case \LineAccountStatus::FOLLOW:
            case \LineAccountStatus::FOLLOW:
                $color = 'red';
                break;
        }

        return $color;
    }
}