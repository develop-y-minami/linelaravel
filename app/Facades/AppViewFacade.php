<?php

namespace App\Facades;

use Illuminate\Support\Facades\Auth;

/**
 * AppViewFacade
 */
class AppViewFacade
{
    /**
     * ログイン担当者種別がサービス提供者の場合非表示
     * 
     * @return string 'style="display:none"'
     */
    public static function hideLoginUserIsServiceProvider()
    {
        return \ViewFacade::hide(\AppFacade::loginUserIsServiceProvider());
    }

    /**
     * 表示モードが編集モード時に非表示
     * 
     * @param int mode 表示モード
     * @return string 'style="display:none"'
     */
    public static function hideUpdate($mode)
    {
        if ($mode == \EditMode::UPDATE)
        {
            return \ViewFacade::hide();
        }
        else
        {
            return '';
        }
    }

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
     * サービス提供者利用停止フラグに対応する色を返却
     * 
     * @param bool useStopFlg 利用停止フラグ
     * @return string 色
     */
    public function serviceProviderUseStopFlgLabelBoxColor($useStopFlg)
    {
        if ($useStopFlg)
        {
            return 'red';
        }
        else
        {
            return 'green';
        }
    }

    /**
     * LINEアカウント状態に対応する色を返却
     * 
     * @param int lineAccountStatus LINEアカウント状態
     * @return string 色
     */
    public static function lineAccountStatusLabelBoxColor($lineAccountStatus)
    {
        switch ($lineAccountStatus)
        {
            case \LineAccountStatus::FOLLOW:
            case \LineAccountStatus::FOLLOW:
                return 'green';
            case \LineAccountStatus::FOLLOW:
            case \LineAccountStatus::FOLLOW:
                return 'red';
        }
    }
}