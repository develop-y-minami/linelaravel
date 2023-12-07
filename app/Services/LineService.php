<?php

namespace App\Services;

use GuzzleHttp\Client;
use LINE\Clients\MessagingApi\Configuration;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Clients\MessagingApi\Model\FlexMessage;
use App\Jsons\LineApis\BotInfo;

/**
 * LineService
 * 
 */
class LineService implements LineServiceInterface
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
     * LineBot
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

    /**
     * TextMessageを返却
     * 
     * @param string text メッセージ
     * 
     * @return TextMessage
     */
    public function getTextMessage($text)
    {
        return new TextMessage(['type' => 'text','text' => $text]);
    }

    /**
     * FlexMessageを返却
     * 
     * @param string altText  メッセージ
     * @param string contents 表示コンテンツ
     * 
     * @return FlexMessage
     */
    public function getFlexMessage($altText, $contents)
    {
        return new FlexMessage(['type' => 'flex','altText' => $altText, 'contents' => $contents]);
    }

    /**
     * リプライメッセージを送信
     * 
     * @param string replyToken リプライトークン
     * @param string text メッセージ
     * 
     * @return ReplyMessageResponse
     */
    public function replyTextMessage($replyToken, $text)
    {
        try
        {
            // テキストメッセージを生成
            $message = $this->getTextMessage($text);

            // リクエストを生成
            $request = new ReplyMessageRequest(['replyToken' => $replyToken, 'messages' => [$message]]);

            // リプライメッセージ送信
            $response = $this->messagingApi->replyMessage($request);

            return $response;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * リプライメッセージ(複数)を送信
     * 
     * @param string replyToken リプライトークン
     * @param array  messages   メッセージ
     * 
     * @return ReplyMessageResponse
     */
    public function replyTextMessages($replyToken, $messages) {
        try
        {
            // リクエストを生成
            $request = new ReplyMessageRequest(['replyToken' => $replyToken, 'messages' => $messages]);

            // リプライメッセージ送信
            $response = $this->messagingApi->replyMessage($request);

            return $response;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * 友達追加時のリプライメッセージを送信
     * 
     * @param string replyToken リプライトークン
     * 
     * @return ReplyMessageResponse
     */
    public function replyFollow($replyToken)
    {
        try
        {
            // テキストメッセージを生成
            $textMessage = $this->getTextMessage('友達追加しましたね！\nユーザー登録をしてください');
            // フレックスメッセージを取得
            $flexMessage = $this->getUserRegisterFlexMessage();

            // リプライメッセージ送信
            $response = $this->replyTextMessages($replyToken, [$textMessage, $flexMessage]);

            return $response;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * ユーザー登録用のフレックスメッセージを返却
     * 
     * @return FlexMessage
     */
    private function getUserRegisterFlexMessage()
    {
        // ユーザー登録メッセージのコンテンツを取得を取得
        $userRegisterFlexContents = $this->getUserRegisterFlexContents();
        // フレックスメッセージを生成
        $flexMessage = $this->getFlexMessage($userRegisterFlexContents['altText'], $userRegisterFlexContents['contents']);

        return $flexMessage;
    }

    /**
     * ユーザー登録用のフレックスメッセージの表示コンテンツを返却
     * 
     * @return array
     */
    private function getUserRegisterFlexContents()
    {
        // 表示コンテンツの配列を生成
        $flexContents = [
            'altText' => 'ユーザー登録',
            'contents' =>  array (
                'type' => 'bubble',
                'body' => 
                array (
                  'type' => 'box',
                  'layout' => 'vertical',
                  'contents' => 
                  array (
                    0 => 
                    array (
                      'type' => 'image',
                      'url' => 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png',
                      'aspectMode' => 'cover',
                      'size' => 'full',
                    ),
                  ),
                  'paddingAll' => 'none',
                ),
                'footer' => 
                array (
                  'type' => 'box',
                  'layout' => 'vertical',
                  'contents' => 
                  array (
                    0 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'uri',
                        'label' => 'ユーザー登録',
                        'uri' => 'https://liff.line.me/2001775635-bAdzwvoB',
                      ),
                      'style' => 'primary',
                    ),
                  ),
                ),
              )
        ];
        
        return $flexContents;
    }
}