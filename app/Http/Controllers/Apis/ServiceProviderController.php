<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceProviderRegisterRequest;
use App\Services\Apis\ServiceProviderApiServiceInterface;
use App\Jsons\ServiceProviderApis\Responses\ServiceProviderRegisterResponse;
use App\Jsons\ServiceProviderApis\Responses\ServiceProvidersResponse;

class ServiceProviderController extends Controller
{
    /**
     * ServiceProviderApiService
     * 
     */
    private $serviceProviderApiService;

    /**
     * __construct
     * 
     * @param ServiceProviderApiServiceInterface serviceProviderApiService
     */
    public function __construct(ServiceProviderApiServiceInterface $serviceProviderApiService)
    {
        $this->serviceProviderApiService = $serviceProviderApiService;
    }

    /**
     * サービス提供者情報を取得する
     * HTTP Method Post
     * https://{host}/api/serviceProvider
     * 
     * @param Request request リクエスト
     * @return Json
     */
    public function serviceProviders(Request $request)
    {
        try
        {
            // パラメータを取得
            $providerId = $request->input('providerId');
            $name = $request->input('name');
            $useStartDateTime = $request->input('useStartDateTime');
            $useEndDateTime = $request->input('useEndDateTime');
            $useStop = $request->input('useStop');

            // キャスト
            $useStop = $useStop == null ? null : (bool)$useStop;

            // サービス提供者情報を取得する
            $serviceProviders = $this->serviceProviderApiService->getServiceProviders($providerId, $name, $useStartDateTime, $useEndDateTime, $useStop);
            
            // レスポンスデータを生成
            $response = new ServiceProvidersResponse($serviceProviders);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * サービス提供者情報を登録する
     * HTTP Method Post
     * https://{host}/api/serviceProvider/register
     * 
     * @param ServiceProviderRegisterRequest request リクエスト
     * @return Json
     */
    public function register(ServiceProviderRegisterRequest $request)
    {
        try
        {
            // パラメータを取得
            $providerId = $request->input('providerId');
            $name = $request->input('name');
            $useStartDateTime = $request->input('useStartDateTime');
            $useEndDateTime = $request->input('useEndDateTime');

            // サービス提供者情報を登録
            $serviceProvider = $this->serviceProviderApiService->register($providerId, $name, $useStartDateTime, $useEndDateTime);

            // レスポンスデータを生成
            $response = new ServiceProviderRegisterResponse($serviceProvider);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
