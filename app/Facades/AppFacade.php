<?php

namespace App\Facades;

use Illuminate\Support\Facades\Auth;

/**
 * AppFacade
 */
class AppFacade
{
    /**
     * 担当者種別が運用者か判定
     * 
     * @param int userType 担当者種別
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
     * 担当者種別がサービス提供者か判定
     * 
     * @param int userType 担当者種別
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
     * 担当者アカウント種別が一般か判定
     * 
     * @param int userType ユーザー種別
     * @return bool
     */
    public static function isUser($userAccountType)
    {
        if (\UserAccountType::USER == $userAccountType)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * ログイン担当者が運用者か判定
     * 
     * @return bool
     */
    public static function loginUserIsOperator()
    {
        return \AppFacade::isOperator(Auth::user()->user_type_id);
    }

    /**
     * ログイン担当者が運用者か判定
     * 
     * @return bool
     */
    public static function loginUserIsUser()
    {
        return \AppFacade::isUser(Auth::user()->user_account_type_id);
    }

    /**
     * ログイン担当者がサービス提供者か判定
     * 
     * @return bool
     */
    public static function loginUserIsServiceProvider()
    {
        return \AppFacade::isServiceProvider(Auth::user()->user_type_id);
    }

    /**
     * ログイン担当者が運用者（一般）か判定
     * 
     */
    public static function loginUserIsOperatorUser()
    {
        if (\AppFacade::loginUserIsOperator() && \AppFacade::loginUserIsUser())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}