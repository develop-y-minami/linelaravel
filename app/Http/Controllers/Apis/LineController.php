<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LineUserSettingRequest;
use App\Services\Apis\LineNoticeApiServiceInterface;
use App\Services\Apis\LineApiServiceInterface;
use App\Jsons\LineApis\Responses\NoticesResponse;
use App\Jsons\LineApis\Responses\LinesResponse;

/**
 * LineController
 * 
 */
class LineController extends Controller
{
    /**
     * LineNoticeApiService
     * 
     */
    private $lineNoticeApiService;

    /**
     * __construct
     * 
     * @param LineNoticeApiServiceInterface lineNoticeApiService
     * @param LineApiServiceInterface       lineApiServiceInterface
     */
    public function __construct(
        LineNoticeApiServiceInterface $lineNoticeApiService,
        LineApiServiceInterface $lineApiServiceInterface
    )
    {
        $this->lineNoticeApiService = $lineNoticeApiService;
        $this->lineApiServiceInterface = $lineApiServiceInterface;
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
            $notices = $this->lineNoticeApiService->getNotices($noticeDate, $lineNoticeTypeId, $displayName, $userId);
            
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
            $lines = $this->lineApiServiceInterface->getLines($lineAccountTypeId, $lineAccountStatusId, $displayName, $userId);
            
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

    /**
     * LINE担当者情報を設定する
     * HTTP Method Post
     * https://{host}/api/line/{id}/user/setting
     * 
     * @param LineUserSettingRequest request リクエスト
     * @param string  id      ID
     * @return Json
     */
    public function userSetting(LineUserSettingRequest $request, $id)
    {
        try
        {
            // パラメータを取得
            $noticeSetting = $request->input('noticeSetting');
            $lineNoticeSttings = $request->input('lineNoticeSttings');
            $userId = $request->input('userId');

            // LINE担当者情報を設定
            $this->lineApiServiceInterface->userSetting((int)$id, $noticeSetting, $lineNoticeSttings, $userId);

            // HTTPステータスコード:200 
            return $this->jsonResponse([]);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
