<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\LineServiceInterface;

/**
 * LineWebhookController
 * 
 */
class LineWebhookController extends Controller
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
    public function __construct(LineServiceInterface $lineService)
    {
        $this->lineService = $lineService;
    }
    
    /**
     * Line Webhook
     * HTTP Method Post
     * https://{host}/api/line/webhook
     * 
     * @param Request request リクエスト
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

                // 応答トークンを取得
                $replyToken = $event['replyToken'];
                
                // webhookイベントのタイプ毎の処理を実行
                switch ($type)
                {
                    // メッセージイベント
                    case 'message':
                        $this->lineService->replyFollow($replyToken);

                        break;
                    
                    // フォローイベント
                    case 'follow':
                        $this->lineService->replyFollow($replyToken);

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
