<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LineMessagingApiServiceInterface;
use App\Jsons\LineMessagingApiApis\Responses\BotInfoResponse;

/**
 * LineMessagingApiController
 * 
 */
class LineMessagingApiController extends Controller
{
    /**
     * LineMessagingApiService
     * 
     */
    private $lineMessagingApiService;

    /**
     * __construct
     * 
     * @param LineMessagingApiServiceInterface lineMessagingApiService
     */
    public function __construct(LineMessagingApiServiceInterface $lineMessagingApiService)
    {
        $this->lineMessagingApiService = $lineMessagingApiService;
    }

    /**
     * ボットの情報を取得する
     * HTTP Method Get
     * https://{host}/api/line/messaging/api/bot/info
     * 
     * @param Request request リクエスト
     * @return Json
     */
    public function botInfo(Request $request)
    {
        try
        {
            // ボットの情報を取得する
            $botInfo = $this->lineMessagingApiService->getBotInfo();

            // レスポンスデータを生成
            $response = new BotInfoResponse($botInfo);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
