<?php

namespace App\Facades;

use Illuminate\Support\Facades\Auth;

/**
 * AppFacade
 * 
 * アプリケーション共通処理
 * 
 */
class AppFacade
{
    /**
     * 担当者種別が運用者か判定
     * 
     * @param int userTypeId 担当者種別情報ID
     * @return bool
     */
    public static function isOperator($userTypeId)
    {
        if (\UserType::OPERATOR == $userTypeId)
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
     * @param int userTypeId 担当者種別情報ID
     * @return bool
     */
    public static function isServiceProvider($userTypeId)
    {
        if (\UserType::SERVICE_PROVIDER == $userTypeId)
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
     * @param int userAccountTypeId 担当者アカウント種別情報ID
     * @return bool
     */
    public static function isUser($userAccountTypeId)
    {
        if (\UserAccountType::USER == $userAccountTypeId)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 担当者アカウント種別が管理者か判定
     * 
     * @param int userAccountTypeId 担当者アカウント種別情報ID
     * @return bool
     */
    public static function isAdmin($userAccountTypeId)
    {
        if (\UserAccountType::ADMIN == $userAccountTypeId)
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
     * ログイン担当者がサービス提供者か判定
     * 
     * @return bool
     */
    public static function loginUserIsServiceProvider()
    {
        return \AppFacade::isServiceProvider(Auth::user()->user_type_id);
    }

    /**
     * ログイン担当者が一般か判定
     * 
     * @return bool
     */
    public static function loginUserIsUser()
    {
        return \AppFacade::isUser(Auth::user()->user_account_type_id);
    }

    /**
     * ログイン担当者が管理者か判定
     * 
     * @return bool
     */
    public static function loginUserIsAdmin()
    {
        return \AppFacade::isAdmin(Auth::user()->user_account_type_id);
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

    /**
     * ログイン担当者がサービス提供者（一般）か判定
     * 
     */
    public static function loginUserIsServiceProviderUser()
    {
        if (\AppFacade::loginUserIsServiceProvider() && \AppFacade::loginUserIsUser())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}