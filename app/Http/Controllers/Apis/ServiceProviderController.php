<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceProviderRegisterRequest;

class ServiceProviderController extends Controller
{
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

            // サービス提供者情報を登録

            // HTTPステータスコード:200 
            return $this->jsonResponse();
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
