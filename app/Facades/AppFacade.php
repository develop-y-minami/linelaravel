<?php

namespace App\Facades;

use Illuminate\Support\Facades\Auth;

/**
 * AppFacade
 */
class AppFacade
{
    /**
     * ユーザー種別が運用者か判定
     * 
     * @param int userType ユーザー種別
     * @return bool
     */
    public static function isOperator($userType)
    {
        if (\UserType::OPERATOR == $userType)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * ユーザー種別がサービス提供者か判定
     * 
     * @param int userType ユーザー種別
     * @return bool
     */
    public static function isServiceProvider($userType)
    {
        if (\UserType::SERVICE_PROVIDER == $userType)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * ログインユーザーが運用者か判定
     * 
     * @return bool
     */
    public static function loginUserIsOperator()
    {
        return \AppFacade::isOperator(Auth::user()->user_type_id);
    }

    /**
     * ログインユーザーがサービス提供者か判定
     * 
     * @return bool
     */
    public static function loginUserIsServiceProvider()
    {
        return \AppFacade::isServiceProvider(Auth::user()->user_type_id);
    }
}