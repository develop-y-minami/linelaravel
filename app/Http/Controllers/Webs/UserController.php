<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Webs\ServiceProviderServiceInterface;
use App\Services\Webs\UserAccountTypeServiceInterface;
use App\Services\Webs\UserServiceInterface;
use App\Services\Webs\UserTypeServiceInterface;
use App\Objects\Pages\UserPage;
use App\Objects\Pages\UsersPage;

/**
 * UserController
 * 
 */
class UserController extends Controller
{
    /**
     * ServiceProviderService
     * 
     */
    private $serviceProviderService;
    /**
     * UserAccountTypeService
     * 
     */
    private $userAccountTypeService;
    /**
     * UserService
     * 
     */
    private $userService;
    /**
     * UserTypeService
     * 
     */
    private $userTypeService;

    /**
     * __construct
     * 
     * @param ServiceProviderServiceInterface serviceProviderService
     * @param UserAccountTypeServiceInterface userAccountTypeService
     * @param UserServiceInterface            userService
     * @param UserTypeServiceInterface        userTypeService
     */
    public function __construct(
        ServiceProviderServiceInterface $serviceProviderService,
        UserAccountTypeServiceInterface $userAccountTypeService,
        UserServiceInterface $userService,
        UserTypeServiceInterface $userTypeService
    )
    {
        $this->serviceProviderService = $serviceProviderService;
        $this->userAccountTypeService = $userAccountTypeService;
        $this->userService = $userService;
        $this->userTypeService = $userTypeService;
    }

    /**
     * 担当者ページ
     * HTTP Method Get
     * https://{host}/user
     * 
     * @param Request request リクエスト
     * @return View
     */
    public function users(Request $request)
    {
        try
        {
            // 担当者種別セレクトボックス設定データを取得
            $userTypeSelectItems = $this->userTypeService->getSelectItems();
            // 担当者種別ラジオボタン設定データを取得
            $userTypeRadioItems = $this->userTypeService->getRadioItems();
            // サービス提供者セレクトボックス設定データを取得
            $serviceProviderSelectItems = $this->serviceProviderService->getSelectItems();
            // 担当者アカウント種別セレクトボックス設定データを取得
            $userAccountTypeSelectItems = $this->userAccountTypeService->getSelectItems();
            // 担当者アカウント種別ラジオボタン設定データを取得
            $userAccountTypeRadioItems = $this->userAccountTypeService->getRadioItems();

            // 返却データに設定
            $result = new UsersPage($userTypeSelectItems, $userTypeRadioItems, $serviceProviderSelectItems, $userAccountTypeSelectItems, $userAccountTypeRadioItems);

            return view('pages.users')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * 担当者ページ
     * HTTP Method Get
     * https://{host}/user/{id}
     * 
     * @param Request request リクエスト
     * @param int     id      担当者ID
     * @return View
     */
    public function user(Request $request, $id)
    {
        try
        {
            // 担当者情報を取得
            $user = $this->userService->getUser($id);
            // 担当者種別セレクトボックス設定データを取得
            $userTypeSelectItems = $this->userTypeService->getSelectItems();
            // 担当者種別ラジオボタン設定データを取得
            $userTypeRadioItems = $this->userTypeService->getRadioItems();
            // サービス提供者セレクトボックス設定データを取得
            $serviceProviderSelectItems = $this->serviceProviderService->getSelectItems();
            // 担当者アカウント種別セレクトボックス設定データを取得
            $userAccountTypeSelectItems = $this->userAccountTypeService->getSelectItems();
            // 担当者アカウント種別ラジオボタン設定データを取得
            $userAccountTypeRadioItems = $this->userAccountTypeService->getRadioItems();

            // 返却データに設定
            $result = new UserPage($user, $userTypeSelectItems, $userTypeRadioItems, $serviceProviderSelectItems, $userAccountTypeSelectItems, $userAccountTypeRadioItems);

            return view('pages.user')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
