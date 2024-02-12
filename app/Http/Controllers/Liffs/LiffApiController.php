<?php

namespace App\Http\Controllers\Liffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LineServiceProviderUpdateRequest;
use App\Http\Requests\VerifyServiceProviderRequest;
use App\Services\Liffs\LiffApiServiceInterface;
use App\Jsons\LiffApis\Responses\UpdateServiceProviderResponse;
use App\Jsons\LiffApis\Responses\VerifyServiceProviderResponse;
use GuzzleHttp\Client;

/**
 * LiffApiController
 * 
 * LIFF Api
 * 
 */
class LiffApiController extends Controller
{
    private const LINE_OAUTH_URI = 'https://access.line.me/oauth2/v2.1/authorize?';
    private const LINE_TOKEN_API_URI = 'https://api.line.me/oauth2/v2.1/';
    private const LINE_PROFILE_API_URI = 'https://api.line.me/v2/';

    /**
     * LiffApiService
     * 
     */
    private $liffApiService;

    /**
     * __construct
     * 
     * @param LiffApiServiceInterface liffApiService
     */
    public function __construct(LiffApiServiceInterface $liffApiService)
    {
        $this->liffApiService = $liffApiService;
    }

    /**
     * アクセストークンを検証する
     * アクセストークンの検証はMiddlewareで実行されこのメソッドでは常に成功をレスポンス
     * HTTP Method Post
     * https://{host}/liff/api/verify/accessToken
     * 
     * @param Request request リクエスト
     * @return Json
     */
    public function verifyAccessToken(Request $request)
    {
        try
        {
            // HTTPステータスコード:200 
            return $this->jsonResponse();
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
    
    /**
     * サービス提供者情報.提供者IDを確認する
     * HTTP Method Post
     * https://{host}/liff/api/verify/serviceProvider
     * 
     * @param VerifyServiceProviderRequest request リクエスト
     * @return Json
     */
    public function verifyServiceProvider(VerifyServiceProviderRequest $request)
    {
        try
        {
            // パラメータを取得
            $providerId = $request->input('providerId');

            // サービス提供者情報を取得
            $serviceProvider = $this->liffApiService->getServiceProviderFindByProviderId($providerId);

            // レスポンスデータを生成
            $response = new VerifyServiceProviderResponse($serviceProvider);

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
     * https://{host}/liff/api/line/{id}/serviceProvider
     * 
     * @param LineServiceProviderUpdateRequest request リクエスト
     * @param int id LINE情報ID
     * @return Json
     */
    public function updateServiceProvider(LineServiceProviderUpdateRequest $request, $id)
    {
        try
        {
            // パラメータを取得
            $serviceProviderId = $request->input('serviceProviderId');
            $liffPageId = $request->input('liffPageId');

            // キャスト
            $id = $id == null ? null : (int)$id;
            $serviceProviderId = $serviceProviderId == null ? null : (int)$serviceProviderId;

            // サービス提供者情報を更新
            $serviceProvider = $this->liffApiService->updateServiceProvider($id, $serviceProviderId);

            // レスポンスデータを生成
            $response = new UpdateServiceProviderResponse($serviceProvider);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
