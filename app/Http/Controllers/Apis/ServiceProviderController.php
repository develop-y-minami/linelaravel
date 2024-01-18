<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceProviderRegisterRequest;
use App\Http\Requests\ServiceProviderUpdateRequest;
use App\Services\Apis\ServiceProviderApiServiceInterface;
use App\Jsons\ServiceProviderApis\Responses\ServiceProviderRegisterResponse;
use App\Jsons\ServiceProviderApis\Responses\ServiceProviderUpdateResponse;
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
            $useStop = $useStop === null ? null : (bool)$useStop;

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
     * HTTP Method Put
     * https://{host}/api/serviceProvider
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

    /**
     * サービス提供者情報を更新する
     * HTTP Method Patch
     * https://{host}/api/serviceProvider/{id}
     * 
     * @param ServiceProviderUpdateRequest request リクエスト
     * @param int                          id      サービス提供者情報ID
     * @return Json
     */
    public function update(ServiceProviderUpdateRequest $request, $id)
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
            $useStop = $useStop === null ? null : (bool)$useStop;

            // サービス提供者情報を更新
            $serviceProvider = $this->serviceProviderApiService->update($id, $providerId, $name, $useStartDateTime, $useEndDateTime, $useStop);

            // レスポンスデータを生成
            $response = new ServiceProviderUpdateResponse($serviceProvider);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * サービス提供者情報を削除する
     * HTTP Method Delete
     * https://{host}/api/serviceProvider/{id}
     * 
     * @param Request request リクエスト
     * @param int     id      サービス提供者情報ID
     * @return Json
     */
    public function destroy(Request $request, $id)
    {
        try
        {
            // サービス提供者情報を削除
            $this->serviceProviderApiService->destroy($id);

            // HTTPステータスコード:200 
            return $this->jsonResponse();
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
