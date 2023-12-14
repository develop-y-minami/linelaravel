<?php

namespace App\Services\Apis;

use GuzzleHttp\Client;
use LINE\Clients\MessagingApi\Configuration;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
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
     * チャネルアクセストークン
     * 
     */
    private $channelAccessToken;
    /**
     * client
     * 
     */
    private $client;
    /**
     * client
     * 
     */
    private $config;
    /**
     * MessagingApi
     * 
     */
    private $messagingApi;

    /**
     * __construct
     * 
     * @param string channelAccessToken チャネルアクセストークン
     */
    public function __construct($channelAccessToken)
    {
        $this->channelAccessToken = $channelAccessToken;
        $this->client = new Client();
        $this->config = new Configuration();
        $this->config->setAccessToken($this->channelAccessToken);
        $this->messagingApi = new MessagingApiApi($this->client, $this->config);
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
            // リプライメッセージ送信
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
}