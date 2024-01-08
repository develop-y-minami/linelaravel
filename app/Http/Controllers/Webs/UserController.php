<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Webs\ServiceProviderServiceInterface;
use App\Services\Webs\UserAccountTypeServiceInterface;
use App\Services\Webs\UserTypeServiceInterface;
use App\Objects\Pages\UserPage;

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
     * UserTypeService
     * 
     */
    private $userTypeService;

    /**
     * __construct
     * 
     * @param ServiceProviderServiceInterface serviceProviderService
     * @param UserAccountTypeServiceInterface userAccountTypeService
     * @param UserTypeServiceInterface        userTypeService
     */
    public function __construct(
        ServiceProviderServiceInterface $serviceProviderService,
        UserAccountTypeServiceInterface $userAccountTypeService,
        UserTypeServiceInterface $userTypeService
    )
    {
        $this->serviceProviderService = $serviceProviderService;
        $this->userAccountTypeService = $userAccountTypeService;
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
    public function index(Request $request)
    {
        try
        {
            // 担当者種別セレクトボックス設定データを取得
            $userTypeSelectItems = $this->userTypeService->getSelectItems();
            // サービス提供者セレクトボックス設定データを取得
            $serviceProviderSelectItems = $this->serviceProviderService->getSelectItems();
            // 担当者アカウント種別セレクトボックス設定データを取得
            $userAccountTypeSelectItems = $this->userAccountTypeService->getSelectItems();

            // 返却データに設定
            $result = new UserPage($userTypeSelectItems, $serviceProviderSelectItems, $userAccountTypeSelectItems);

            return view('pages.user')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
