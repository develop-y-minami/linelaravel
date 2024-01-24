<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LineServiceProviderUpdateRequest;
use App\Http\Requests\LineUserSettingRequest;
use App\Services\Apis\LineApiServiceInterface;
use App\Jsons\LineApis\Responses\LinesResponse;
use App\Jsons\LineApis\Responses\NoticesResponse;
use App\Jsons\LineApis\Responses\TalkHistorysResponse;

/**
 * LineController
 * 
 * LINE情報
 * 
 */
class LineController extends Controller
{
    /**
     * LineApiServiceInterface
     * 
     */
    private $lineApiServiceInterface;

    /**
     * __construct
     * 
     * @param LineApiServiceInterface lineApiServiceInterface
     */
    public function __construct(LineApiServiceInterface $lineApiServiceInterface)
    {
        $this->lineApiServiceInterface = $lineApiServiceInterface;
    }

    /**
     * LINE情報を取得する
     * HTTP Method Post
     * https://{host}/api/line
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
            $lineChannelDisplayName = $request->input('lineChannelDisplayName');
            $serviceProviderId = $request->input('serviceProviderId');
            $userId = $request->input('userId');

            // キャスト
            $lineAccountTypeId = $lineAccountTypeId == null ? null : (int)$lineAccountTypeId;
            $lineAccountStatusId = $lineAccountStatusId == null ? null : (int)$lineAccountStatusId;
            $serviceProviderId = $serviceProviderId == null ? null : (int)$serviceProviderId;
            $userId = $userId == null ? null : (int)$userId;

            // LINE情報を取得する
            $lines = $this->lineApiServiceInterface->getLines($lineAccountTypeId, $lineAccountStatusId, $lineChannelDisplayName, $serviceProviderId, $userId);
            
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
            $lineChannelDisplayName = $request->input('lineChannelDisplayName');
            $serviceProviderId = $request->input('serviceProviderId');
            $userId = $request->input('userId');

            // キャスト
            $lineNoticeTypeId = $lineNoticeTypeId == null ? null : (int)$lineNoticeTypeId;
            $serviceProviderId = $serviceProviderId == null ? null : (int)$serviceProviderId;
            $userId = $userId == null ? null : (int)$userId;

            // LINE通知情報を取得する
            $notices = $this->lineApiServiceInterface->getNotices($noticeDate, $lineNoticeTypeId, $lineChannelDisplayName, $serviceProviderId, $userId);
            
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
     * サービス提供者を設定する
     * HTTP Method Patch
     * https://{host}/api/line/serviceProvider
     * 
     * @param LineServiceProviderUpdateRequest request リクエスト
     * @return Json
     */
    public function updatesServiceProvider(LineServiceProviderUpdateRequest $request)
    {
        try
        {
            // パラメータを取得
            $ids = $request->input('ids');
            $serviceProviderId = $request->input('serviceProviderId');

            // キャスト
            $serviceProviderId = $serviceProviderId == null ? null : (int)$serviceProviderId;

            // サービス提供者情報を更新する
            $lines = $this->lineApiServiceInterface->updatesServiceProvider($ids, $serviceProviderId);
            
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
     * @param string                 id      ID
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
            return $this->jsonResponse();
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * LINEトーク履歴を取得する
     * HTTP Method Post
     * https://{host}/api/line/{id}/talk/historys
     * 
     * @param Request request リクエスト
     * @param string  id      ID
     * @return Json
     */
    public function talkHistorys(Request $request, $id)
    {
        try
        {
            // パラメータを取得
            $lineTalkHistoryTerm = $request->input('lineTalkHistoryTerm');

            // キャスト
            $lineTalkHistoryTerm = $lineTalkHistoryTerm == null ? null : (int)$lineTalkHistoryTerm;

            // LINE情報を取得
            $line = $this->lineApiServiceInterface->getLine((int)$id);
            // LINEトーク履歴を取得
            $talkHistorys = $this->lineApiServiceInterface->talkHistorys((int)$id, $lineTalkHistoryTerm);

            // レスポンスデータを生成
            $response = new TalkHistorysResponse($line, $talkHistorys);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
