<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Repositorys\LineMessageImageRepositoryInterface;
use App\Repositorys\LineMessageRepositoryInterface;
use App\Repositorys\LineMessageTextRepositoryInterface;
use App\Repositorys\LineNoticeRepositoryInterface;
use App\Repositorys\LineNoticeTypeRepositoryInterface;
use App\Repositorys\LineRepositoryInterface;
use LINE\Clients\MessagingApi\Configuration;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Clients\MessagingApi\Model\FlexMessage;

/**
 * LineWebhookService
 * 
 */
class LineWebhookService implements LineWebhookServiceInterface
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
     * LineNoticeRepositoryInterface
     * 
     */
    private $lineNoticeRepository;
    /**
     * LineNoticeTypeRepositoryInterface
     * 
     */
    private $lineNoticeTypeRepository;
    /**
     * LineRepositoryInterface
     * 
     */
    private $lineRepository;

    /**
     * __construct
     * 
     * @param string                              channelAccessToken チャネルアクセストークン
     * @param LineMessageImageRepositoryInterface lineMessageImageRepository
     * @param LineMessageRepositoryInterface      lineMessageRepository
     * @param LineMessageTextRepositoryInterface  lineMessageTextRepository
     * @param LineNoticeRepositoryInterface       lineNoticeRepository
     * @param LineNoticeTypeRepositoryInterface   lineNoticeTypeRepository
     * @param LineRepositoryInterface             lineRepository
     */
    public function __construct(
        $channelAccessToken,
        LineMessageImageRepositoryInterface $lineMessageImageRepository,
        LineMessageRepositoryInterface $lineMessageRepository,
        LineMessageTextRepositoryInterface $lineMessageTextRepository,
        LineNoticeRepositoryInterface $lineNoticeRepository,
        LineNoticeTypeRepositoryInterface $lineNoticeTypeRepository,
        LineRepositoryInterface $lineRepository
    )
    {
        $this->channelAccessToken = $channelAccessToken;
        $this->client = new Client();
        $this->config = new Configuration();
        $this->config->setAccessToken($this->channelAccessToken);
        $this->messagingApi = new MessagingApiApi($this->client, $this->config);
        $this->lineMessageImageRepository = $lineMessageImageRepository;
        $this->lineMessageRepository = $lineMessageRepository;
        $this->lineMessageTextRepository = $lineMessageTextRepository;
        $this->lineNoticeRepository = $lineNoticeRepository;
        $this->lineNoticeTypeRepository = $lineNoticeTypeRepository;
        $this->lineRepository = $lineRepository;
    }

    /**
     * LINE情報を登録
     * 
     * @param string                 userId            ユーザーID
     * @param LineAccountStatus lineAccountStatus LINEアカウント状態
     * @param LineAccountType   lineAccountType   LINEアカウント種別
     * @return Line LINE情報
     */
    private function createLine($userId, $lineAccountStatus, $lineAccountType)
    {
        try
        {
            // LINEプロフィール情報を取得
            $response = $this->messagingApi->getProfile($userId);
            $displayName = $response->getDisplayName();
            $pictureUrl = $response->getPictureUrl();

            // LINE情報に登録
            return $this->lineRepository->create(
                $userId,
                $displayName,
                $pictureUrl,
                $lineAccountStatus,
                $lineAccountType
            );
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * LINE通知情報を登録
     * 
     * @param string type      タイプ
     * @param int    lineId    LINE情報ID
     * @param int    timestamp タイムスタンプ
     * @return LineNotice LINE通知情報
     */
    public function createLineNotice($type, $lineId, $timestamp)
    {
        try
        {
            // 通知日時を設定
            $noticeDateTime = date("Y-m-d H:i:s", $timestamp / 1000);

            // 通知種別の情報を取得
            $lineNoticeTypes = $this->lineNoticeTypeRepository->findByType($type);
            $lineNoticeTypeId = $lineNoticeTypes->id;
            $content = $lineNoticeTypes->content;

            // LINE通知情報を取得
            return $this->lineNoticeRepository->create($noticeDateTime, $lineNoticeTypeId, $lineId, $content);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * メッセージイベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param array  source    送信元情報
     * @param array  message   メッセージ情報
     * @param int    timestamp タイムスタンプ
     */
    public function message($type, $source, $message, $timestamp)
    {
        try
        {
            // sourseタイプを取得
            $sourceType = $source['type'];

            // idを設定
            $sourceId;
            if ($sourceType == 'user')
            {
                // ユーザーIDを設定
                $sourceId = $source['userId'];
            }
            else
            {
                // グループIDを設定
                $sourceId = $source['groupId'];
            }

            // LINE情報を取得
            $line = $this->lineRepository->findByAccountId($sourceId);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->createLine($sourceId, \LineAccountStatus::FOLLOW, \LineAccountType::ONE_TO_ONE);
            }

            // LINE通知情報を作成
            $lineNotice = $this->createLineNotice($type, $line->id, $timestamp);

            // LINEメッセージ情報を登録
            $messageType = $message['type'];
            $messageId = $message['id'];
            $messageQuoteToken = $message['quoteToken'];
            $lineMessage = $this->lineMessageRepository->create($messageType, $messageId, $messageQuoteToken);

            // メッセージタイプに対応する処理を実行
            switch ($messageType)
            {
                case \LineMessageType::TEXT:
                    // LINEテキストメッセージを登録
                    $text = $message['text'];
                    $this->lineMessageTextRepository->create($lineMessage->id, $text);
                    break;
                case \LineMessageType::IMAGE:
                    // LINE画像メッセージを登録
                    $contentProvider = $message['contentProvider'];
                    $contentProviderType = $contentProvider['type'];
                    $contentProviderOriginalContentUrl = \AppFacade::getArrayValue($contentProvider, 'originalContentUrl');
                    $contentProviderPreviewImageUrl = \AppFacade::getArrayValue($contentProvider, 'previewImageUrl');
                    $imageSet = \AppFacade::getArrayValue($message, 'imageSet');
                    $imageSetId = null;
                    $imageSetIndex = null;
                    $imageSetTotal = null;
                    if ($imageSet != null)
                    {
                        $imageSetId = $imageSet['id'];
                        $imageSetIndex = $imageSet['index'];
                        $imageSetTotal = $imageSet['total'];
                    }
                    $this->lineMessageImageRepository->create(
                        $lineMessage->id,
                        $contentProviderType,
                        $contentProviderOriginalContentUrl,
                        $contentProviderPreviewImageUrl,
                        $imageSetId,
                        $imageSetIndex,
                        $imageSetTotal
                    );
                    break;
            }
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * フォローイベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string userId    ユーザーID
     * @param int    timestamp タイムスタンプ
     */
    public function follow($type, $userId, $timestamp)
    {
        try
        {
            // LINE情報を取得
            $line = $this->lineRepository->findByAccountId($userId);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->createLine($userId, \LineAccountStatus::FOLLOW, \LineAccountType::ONE_TO_ONE);
            }
            else
            {
                // LINE情報が既に登録済み時の処理を実行
                if ($line->line_account_status_id == \LineAccountStatus::UNFOLLOW)
                {
                    // ブロック中の場合は友達に状態を変更
                    $line = $this->lineRepository->saveLineAccountStatus($line, \LineAccountStatus::FOLLOW);
                }
            }

            // LINE通知情報を作成
            $lineNotice = $this->createLineNotice($type, $line->id, $timestamp);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * フォロー解除イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string userId    ユーザーID
     * @param int    timestamp タイムスタンプ
     */
    public function unfollow($type, $userId, $timestamp)
    {
        try
        {
            // LINE情報を取得
            $line = $this->lineRepository->findByAccountId($userId);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->createLine($userId, \LineAccountStatus::UNFOLLOW, \LineAccountType::ONE_TO_ONE);
            }
            else
            {
                // LINE情報が既に登録済み時の処理を実行
                if ($line->line_account_status_id == \LineAccountStatus::FOLLOW)
                {
                    // ブロック中の場合は友達に状態を変更
                    $line = $this->lineRepository->saveLineAccountStatus($line, \LineAccountStatus::UNFOLLOW);
                }
            }

            // LINE通知情報を作成
            $lineNotice = $this->createLineNotice($type, $line->id, $timestamp);
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