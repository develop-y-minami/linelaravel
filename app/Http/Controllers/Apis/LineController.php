<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LineServiceInterface;

/**
 * LineController
 * 
 */
class LineController extends Controller
{
    /**
     * LineService
     * 
     */
    private $lineService;

    /**
     * __construct
     * 
     * @param LineServiceInterface lineService LineService
     */
    public function __construct(LineServiceInterface $lineService) {
        $this->lineService = $lineService;
    }

    /**
     * ボットの情報を取得する
     * HTTP Method Get
     * https://{host}/api/line/bot/info
     * 
     * @param Request request リクエスト
     */
    public function botInfo(Request $request) {
        try {
            // ボットの情報を取得する
            $data = $this->lineService->getBotInfo();

            // HTTPステータスコード:200 
            return $this->jsonResponse($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
