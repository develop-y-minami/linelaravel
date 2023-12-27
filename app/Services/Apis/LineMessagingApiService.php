<?php

namespace App\Services\Apis;

use GuzzleHttp\Client;
use LINE\Clients\MessagingApi\Configuration;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Api\MessagingApiBlobApi;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Clients\MessagingApi\Model\FlexMessage;
use App\Jsons\LineMessagingApiApis\BotInfo;

/**
 * LineMessagingApiService
 * 
 */
class LineMessagingApiService implements LineMessagingApiServiceInterface
{
    /**
     * MessagingApiApi
     * 
     */
    protected $messagingApi;
    /**
     * MessagingApiBlobApi
     * 
     */
    protected $messagingApiBlobApi;

    /**
     * __construct
     * 
     * @param string channelAccessToken チャネルアクセストークン
     */
    public function __construct($channelAccessToken)
    {
        $channelAccessToken = $channelAccessToken;
        $client = new Client();
        $config = new Configuration();
        $config->setAccessToken($channelAccessToken);
        $this->messagingApi = new MessagingApiApi($client, $config);
        $this->messagingApiBlobApi = new MessagingApiBlobApi($client, $config);
    }

    /**
     * ボットの情報を取得する
     * 
     * @return BotInfo
     */
    public function getBotInfo()
    {
        try
        {
            // ボット情報取得
            $response = $this->messagingApi->getBotInfo();

            // ボットの情報を取得
            $basicId = $response->getBasicId();
            $displayName = $response->getDisplayName();
            $pictureUrl = $response->getPictureUrl();

            return new BotInfo($basicId, $displayName, $pictureUrl);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * メッセージコンテンツを取得
     * 
     * @param string messageId メッセージID
     * @return string メッセージコンテンツ
     */
    public function getMessageContent($messageId)
    {
        try
        {
            // メッセージコンテンツを取得
            $response = $this->messagingApiBlobApi->getMessageContent($messageId);

            // データを取得
            return $response->fread($response->getSize());
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}