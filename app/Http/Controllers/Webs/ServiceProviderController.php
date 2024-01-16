<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Webs\ServiceProviderServiceInterface;
use App\Services\Webs\UserAccountTypeServiceInterface;
use App\Services\Webs\UserTypeServiceInterface;
use App\Objects\Pages\ServiceProviderPage;
use App\Objects\Pages\ServiceProvidersPage;

/**
 * ServiceProviderController
 * 
 */
class ServiceProviderController extends Controller
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
     * サービス提供者ページ
     * HTTP Method Get
     * https://{host}/serviceProvider
     * 
     * @param Request request リクエスト
     * @return View
     */
    public function serviceProviders(Request $request)
    {
        try
        {
            // 担当者種別ラジオボタン設定データを取得
            $userTypeRadioItems = $this->userTypeService->getRadioItems();
            // サービス提供者セレクトボックス設定データを取得
            $serviceProviderSelectItems = $this->serviceProviderService->getSelectItems();
            // 担当者アカウント種別ラジオボタン設定データを取得
            $userAccountTypeRadioItems = $this->userAccountTypeService->getRadioItems();

            // 返却データに設定
            $result = new ServiceProvidersPage($userTypeRadioItems, $serviceProviderSelectItems, $userAccountTypeRadioItems);

            return view('pages.serviceProviders')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * サービス提供者ページ
     * HTTP Method Get
     * https://{host}/serviceProvider/{id}
     * 
     * @param Request request リクエスト
     * @param int     id      サービス提供者ID
     * @return View
     */
    public function serviceProvider(Request $request, $id)
    {
        try
        {
            // サービス提供者情報を取得
            $serviceProvider = $this->serviceProviderService->getServiceProvider($id);

            if ($serviceProvider != null)
            {
                // 担当者種別ラジオボタン設定データを取得
                $userTypeRadioItems = $this->userTypeService->getRadioItems();
                // サービス提供者セレクトボックス設定データを取得
                $serviceProviderSelectItems = $this->serviceProviderService->getSelectItems();
                // 担当者アカウント種別ラジオボタン設定データを取得
                $userAccountTypeRadioItems = $this->userAccountTypeService->getRadioItems();

                // 返却データに設定
                $result = new ServiceProviderPage($serviceProvider, $userTypeRadioItems, $serviceProviderSelectItems, $userAccountTypeRadioItems);

                return view('pages.serviceProvider')->with('data', $result);
            }
            else
            {
                abort(404);
            }
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
