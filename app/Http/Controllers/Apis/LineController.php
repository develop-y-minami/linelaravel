<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LineNoticeServiceInterface;
use App\Jsons\LineApis\Responses\NoticeResponse;

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
     */
    public function __construct(LineNoticeServiceInterface $lineNoticeService)
    {
        $this->lineNoticeService = $lineNoticeService;
    }

    /**
     * LINE通知情報を取得する
     * HTTP Method Post
     * https://{host}/api/line/notice
     * 
     * @param Request request リクエスト
     * @return Json
     */
    public function notice(Request $request)
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
            $response = new NoticeResponse($notices);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
