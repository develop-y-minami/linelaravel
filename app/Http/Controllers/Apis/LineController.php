<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LineNoticeServiceInterface;
use App\Services\LineServiceInterface;
use App\Jsons\LineApis\Responses\NoticesResponse;
use App\Jsons\LineApis\Responses\LinesResponse;

/**
 * LineController
 * 
 */
class LineController extends Controller
{
    /**
     * LineNoticeService
     * 
     */
    private $lineNoticeService;

    /**
     * __construct
     * 
     * @param LineNoticeServiceInterface lineNoticeService
     * @param LineServiceInterface       lineServiceInterface
     */
    public function __construct(
        LineNoticeServiceInterface $lineNoticeService,
        LineServiceInterface $lineServiceInterface
    )
    {
        $this->lineNoticeService = $lineNoticeService;
        $this->lineServiceInterface = $lineServiceInterface;
    }

    /**
     * LINE通知情報を取得する
     * HTTP Method Post
     * https://{host}/api/line/notices
     * 
     * @param Request request リクエスト
     * @return Json
     */
    public function notices(Request $request)
    {
        try
        {
            // パラメータを取得
            $noticeDate = $request->input('noticeDate');
            $lineNoticeTypeId = $request->input('lineNoticeTypeId');
            $displayName = $request->input('displayName');
            $userId = $request->input('userId');

            // キャスト
            $lineNoticeTypeId = $lineNoticeTypeId == null ? null : (int)$lineNoticeTypeId;
            $userId = $userId == null ? null : (int)$userId;

            // LINE通知情報を取得する
            $notices = $this->lineNoticeService->getNotices($noticeDate, $lineNoticeTypeId, $displayName, $userId);
            
            // レスポンスデータを生成
            $response = new NoticesResponse($notices);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * LINE情報を取得する
     * HTTP Method Post
     * https://{host}/api/line/lines
     * 
     * @param Request request リクエスト
     * @return Json
     */
    public function lines(Request $request)
    {
        try
        {
            // パラメータを取得
            $lineAccountTypeId = $request->input('lineAccountTypeId');
            $lineAccountStatusId = $request->input('lineAccountStatusId');
            $displayName = $request->input('displayName');
            $userId = $request->input('userId');

            // キャスト
            $lineAccountTypeId = $lineAccountTypeId == null ? null : (int)$lineAccountTypeId;
            $lineAccountStatusId = $lineAccountStatusId == null ? null : (int)$lineAccountStatusId;
            $userId = $userId == null ? null : (int)$userId;

            // LINE情報を取得する
            $lines = $this->lineServiceInterface->getLines($lineAccountTypeId, $lineAccountStatusId, $displayName, $userId);
            
            // レスポンスデータを生成
            $response = new LinesResponse($lines);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
