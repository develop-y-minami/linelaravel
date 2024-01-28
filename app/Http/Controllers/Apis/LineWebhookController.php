<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Apis\LineWebhookServiceInterface;

/**
 * LineWebhookController
 * 
 * LINE Webhook
 * 
 */
class LineWebhookController extends Controller
{
    /**
     * LineWebhookService
     * 
     */
    private $lineWebhookService;

    /**
     * __construct
     * 
     * @param LineWebhookServiceInterface lineWebhookService
     */
    public function __construct(LineWebhookServiceInterface $lineWebhookService)
    {
        $this->lineWebhookService = $lineWebhookService;
    }
    
    /**
     * Line Webhook
     * HTTP Method Post
     * https://{host}/api/line/webhook
     * 
     * @param Request request リクエスト
     * @return int HTTPステータスコード
     */
    public function webhook(Request $request)
    {
        try
        {
            // webhookイベントを取得
            $events = $request->input('events');

            // 受信したwebhookイベントを順次処理
            foreach($events as $event)
            {
                // webhookイベントのタイプを取得
                $type = $event['type'];
                // チャネル状態を取得
                $mode = \ArrayFacade::getArrayValue($event, 'mode');
                // 応答トークンを取得
                $replyToken = \ArrayFacade::getArrayValue($event, 'replyToken');
                // タイムスタンプを取得
                $timestamp = \ArrayFacade::getArrayValue($event, 'timestamp');
                // ソースを取得
                $source = \ArrayFacade::getArrayValue($event, 'source');
                
                // webhookイベントのタイプ毎の処理を実行
                switch ($type)
                {
                    // メッセージイベント
                    case 'message':
                        $this->lineWebhookService->message($type, $source, $event['message'], $timestamp);
                        break;
                    // フォローイベント
                    case 'follow':
                        $this->lineWebhookService->follow($mode, $replyToken, $type, $source['userId'], $timestamp);
                        break;
                    // フォロー解除イベント
                    case 'unfollow':
                        $this->lineWebhookService->unfollow($type, $source['userId'], $timestamp);
                        break;
                    // グループ参加イベント
                    case 'join':
                        $this->lineWebhookService->join($type, $source['groupId'], $timestamp);
                        break;
                    // グループ退出イベント
                    case 'leave':
                        $this->lineWebhookService->leave($type, $source['groupId'], $timestamp);
                        break;
                    // メンバー退出イベント
                    case 'memberLeft':
                        // 退出メンバーを取得
                        $left = \ArrayFacade::getArrayValue($event, 'left');
                        $members = \ArrayFacade::getArrayValue($left, 'members');
                        $this->lineWebhookService->memberLeft($type, $source['groupId'], $members, $timestamp);
                        break;
                    default:
                        break;
                }

            }

            // HTTPステータスコード:200 
            return Response::HTTP_CREATED;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
