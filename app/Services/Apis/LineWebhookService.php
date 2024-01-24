<?php

namespace App\Services\Apis;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Clients\MessagingApi\Model\FlexMessage;
use App\Repositorys\LineMessageImageRepositoryInterface;
use App\Repositorys\LineMessageRepositoryInterface;
use App\Repositorys\LineMessageTypeRepositoryInterface;
use App\Repositorys\LineMessageTextRepositoryInterface;
use App\Repositorys\LineNoticeRepositoryInterface;
use App\Repositorys\LineNoticeTypeRepositoryInterface;
use App\Repositorys\LineRepositoryInterface;
use App\Repositorys\LineSendMessageRepositoryInterface;
use App\Repositorys\LineSendMessageTextRepositoryInterface;

/**
 * LineWebhookService
 * 
 * LINE Webhook
 * 
 */
class LineWebhookService extends LineMessagingApiService  implements LineWebhookServiceInterface
{
    /**
     * lineMessageImageRepository
     * 
     */
    private $lineMessageImageRepository;
    /**
     * lineMessageRepository
     * 
     */
    private $lineMessageRepository;
    /**
     * lineMessageTypeRepository
     * 
     */
    private $lineMessageTypeRepository;
    /**
     * lineMessageTextRepository
     * 
     */
    private $lineMessageTextRepository;
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
     * LineSendMessageRepositoryInterface
     * 
     */
    private $lineSendMessageRepository;
    /**
     * LineSendMessageTextRepositoryInterface
     * 
     */
    private $lineSendMessageTextRepository;

    /**
     * __construct
     * 
     * @param string                                 channelAccessToken チャネルアクセストークン
     * @param LineMessageImageRepositoryInterface    lineMessageImageRepository
     * @param LineMessageRepositoryInterface         lineMessageRepository
     * @param LineMessageTypeRepositoryInterface     lineMessageTypeRepository
     * @param LineMessageTextRepositoryInterface     lineMessageTextRepository
     * @param LineNoticeRepositoryInterface          lineNoticeRepository
     * @param LineNoticeTypeRepositoryInterface      lineNoticeTypeRepository
     * @param LineRepositoryInterface                lineRepository
     * @param LineSendMessageRepositoryInterface     lineSendMessageRepository
     * @param LineSendMessageTextRepositoryInterface lineSendMessageTextRepository
     */
    public function __construct(
        $channelAccessToken,
        LineMessageImageRepositoryInterface $lineMessageImageRepository,
        LineMessageRepositoryInterface $lineMessageRepository,
        LineMessageTypeRepositoryInterface $lineMessageTypeRepository,
        LineMessageTextRepositoryInterface $lineMessageTextRepository,
        LineNoticeRepositoryInterface $lineNoticeRepository,
        LineNoticeTypeRepositoryInterface $lineNoticeTypeRepository,
        LineRepositoryInterface $lineRepository,
        LineSendMessageRepositoryInterface $lineSendMessageRepository,
        LineSendMessageTextRepositoryInterface $lineSendMessageTextRepository
    )
    {
        parent::__construct($channelAccessToken);
        $this->lineMessageImageRepository = $lineMessageImageRepository;
        $this->lineMessageRepository = $lineMessageRepository;
        $this->lineMessageTypeRepository = $lineMessageTypeRepository;
        $this->lineMessageTextRepository = $lineMessageTextRepository;
        $this->lineNoticeRepository = $lineNoticeRepository;
        $this->lineNoticeTypeRepository = $lineNoticeTypeRepository;
        $this->lineRepository = $lineRepository;
        $this->lineSendMessageRepository = $lineSendMessageRepository;
        $this->lineSendMessageTextRepository = $lineSendMessageTextRepository;
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
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // sourseタイプを取得
            $sourceType = \ArrayFacade::getArrayValue($source, 'type');

            // IDを保持
            $sourceId;

            // LINE情報を保持
            $line;

            if ($sourceType == 'user')
            {
                // ユーザーIDを設定
                $sourceId = \ArrayFacade::getArrayValue($source, 'userId');
                // LINE情報を取得
                $line = $this->lineRepository->findByLineChannelUserId($sourceId);
                if ($line == null)
                {
                    // LINE情報に登録
                    $line = $this->registerLineOneToOne($sourceId, \LineAccountStatus::FOLLOW, \LineAccountType::ONE_TO_ONE);
                }
            }
            else
            {
                // グループIDを設定
                $sourceId = \ArrayFacade::getArrayValue($source, 'groupId');
            }

            // LINEメッセージ種別を取得
            $messageType = \ArrayFacade::getArrayValue($message, 'type');
            $lineMessageType = $this->lineMessageTypeRepository->findByName($messageType);

            // LINE通知情報を作成
            $lineNotice = $this->registerLineNotice($type, $line->id, $timestamp);

            // LINEメッセージ情報を登録
            $lineMessage = $this->registerLineMessage($lineMessageType->id, $message, $lineNotice->id);

            // メッセージタイプに対応する処理を実行
            switch ($lineMessageType->id)
            {
                case \LineMessageType::TEXT:
                    // LINEテキストメッセージを登録
                    $this->registerLineMessageText($lineMessage->id, $message);
                    break;
                case \LineMessageType::IMAGE:
                    // LINE画像メッセージを登録
                    $this->registerLineMessageImage($line->id, $lineMessage->id, $message);
                    break;
            }

            // コミット
            \DB::commit();
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * フォローイベント時の処理を実行
     * 
     * @param string mode       チャネル状態
     * @param string replyToken リプライトークン
     * @param string type       タイプ
     * @param string userId     ユーザーID
     * @param int    timestamp  タイムスタンプ
     */
    public function follow($mode, $replyToken, $type, $userId, $timestamp)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // LINE情報を取得
            $line = $this->lineRepository->findByLineChannelUserId($userId);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->registerLineOneToOne($userId, \LineAccountStatus::FOLLOW, \LineAccountType::ONE_TO_ONE);
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
            $lineNotice = $this->registerLineNotice($type, $line->id, $timestamp);

            if ($mode == \LineChannelMode::ACTIVE)
            {
                // リプライメッセージ送信
                $this->replyFollow($replyToken, $line->id, $line->display_name);
            }

            // コミット
            \DB::commit();
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
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
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // LINE情報を取得
            $line = $this->lineRepository->findByLineChannelUserId($userId);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->registerLine($userId, \LineAccountStatus::UNFOLLOW, \LineAccountType::ONE_TO_ONE);
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
            $lineNotice = $this->registerLineNotice($type, $line->id, $timestamp);

            // コミット
            \DB::commit();
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * LINE情報を登録
     * 
     * @param string            userId            ユーザーID
     * @param LineAccountStatus lineAccountStatus LINEアカウント状態
     * @param LineAccountType   lineAccountType   LINEアカウント種別
     * @return Line LINE情報
     */
    private function registerLineOneToOne($userId, $lineAccountStatus, $lineAccountType)
    {
        try
        {
            // LINEプロフィール情報を取得
            $response = $this->messagingApi->getProfile($userId);
            $displayName = $response->getDisplayName();
            $pictureUrl = $response->getPictureUrl();

            // LINE情報に登録
            return $this->lineRepository->register(
                $userId,
                null,
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
     * @param string type          タイプ
     * @param int    lineId        LINE情報ID
     * @param int    timestamp     タイムスタンプ
     * @return LineNotice LINE通知情報
     */
    private function registerLineNotice($type, $lineId, $timestamp)
    {
        try
        {
            // 通知日時を設定
            $noticeDateTime = date("Y-m-d H:i:s", $timestamp / 1000);

            // 通知種別の情報を取得
            $lineNoticeTypes = $this->lineNoticeTypeRepository->findByType($type);
            $lineNoticeTypeId = $lineNoticeTypes->id;
            $content = $lineNoticeTypes->content;

            // LINE通知情報に登録
            return $this->lineNoticeRepository->register($noticeDateTime, $lineNoticeTypeId, $lineId, $content);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * LINEメッセージ情報を登録
     * 
     * @param int    lineMessageTypeId LINEメッセージ種別情報ID
     * @param array  message           メッセージ情報
     * @param int    lineNoticeId      LINE通知情報ID
     * @return LineMessage LINEメッセージ情報
     */
    private function registerLineMessage($lineMessageTypeId, $message, $lineNoticeId) {
        try
        {
            // 登録情報を取得
            $messageId = \ArrayFacade::getArrayValue($message, 'id');
            $messageQuoteToken = \ArrayFacade::getArrayValue($message, 'quoteToken');
            // LINEメッセージ情報に登録
            return $this->lineMessageRepository->register($lineMessageTypeId, $messageId, $messageQuoteToken, $lineNoticeId);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * LINEメッセージテキスト情報を登録
     * 
     * @param int    lineMessageId LINEメッセージ情報ID
     * @param array  message       メッセージ情報
     * @return LineMessageText LINEメッセージテキスト情報
     */
    private function registerLineMessageText($lineMessageId, $message) {
        try
        {
            // 登録情報を取得
            $text = \ArrayFacade::getArrayValue($message, 'text');
            // LINEメッセージテキスト情報に登録
            return $this->lineMessageTextRepository->register($lineMessageId, $text);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * LINEメッセージ画像情報を登録
     * 
     * @param int    lineId        LINE情報ID
     * @param int    lineMessageId LINEメッセージ情報ID
     * @param array  message       メッセージ情報
     * @return LineMessageImage LINEメッセージ画像情報
     */
    private function registerLineMessageImage($lineId, $lineMessageId, $message) {
        try
        {
            // 登録情報を取得
            $messageId = \ArrayFacade::getArrayValue($message, 'id');
            $contentProvider = $message['contentProvider'];
            $contentProviderType = $contentProvider['type'];
            $contentProviderOriginalContentUrl = \ArrayFacade::getArrayValue($contentProvider, 'originalContentUrl');
            $contentProviderPreviewImageUrl = \ArrayFacade::getArrayValue($contentProvider, 'previewImageUrl');
            $imageSet = \ArrayFacade::getArrayValue($message, 'imageSet');
            $imageSetId = null;
            $imageSetIndex = null;
            $imageSetTotal = null;
            if ($imageSet != null)
            {
                $imageSetId = $imageSet['id'];
                $imageSetIndex = $imageSet['index'];
                $imageSetTotal = $imageSet['total'];
            }

            // 画像ファイル保存先のディレクトリを作成
            $baseDirectory = config('line.save_file_directory');
            $lineImageDirectory = $baseDirectory.'/'.$lineId.'/image';
            if (Storage::exists($lineImageDirectory) == false)
            {
                Storage::makeDirectory($lineImageDirectory);
            }

            // 画像ファイルを取得
            $image = $this->getMessageContent($messageId);

            // ファイル名を生成
            $lineImageFileName = $lineImageDirectory.'/'.$lineMessageId.'.png';

            // ファイルを保存
            Storage::disk('public')->put($lineImageFileName , $image);

            // ファイルパスを設定
            $lineImageFilePath = 'storage/'.$lineImageFileName;

            // LINEメッセージ画像情報に登録
            return $this->lineMessageImageRepository->register(
                $lineMessageId,
                $contentProviderType,
                $contentProviderOriginalContentUrl,
                $contentProviderPreviewImageUrl,
                $imageSetId,
                $imageSetIndex,
                $imageSetTotal,
                $lineImageFilePath
            );
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
     * @param string text       メッセージ
     * @param string lineId     LINE情報ID
     * 
     * @return ReplyMessageResponse
     */
    private function replyTextMessage($replyToken, $text, $lineId)
    {
        try
        {
            // 送信日時を取得
            $sendDateTime = Carbon::now()->format('Y-m-d H:i:s.v');

            // LINE送信メッセージ情報を登録
            $lineSendMessage = $this->lineSendMessageRepository->create(
                $sendDateTime,
                \LineSendMessageOrigin::REPLY,
                \LineSendMessageType::TEXT,
                $lineId,
                0
            );

            // LINE送信テキストメッセージ情報を登録
            $lineSendMessageText = $this->lineSendMessageTextRepository->create($lineSendMessage->id, $text);

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
    private function replyTextMessages($replyToken, $messages) {
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
     * @param string lineId      LINE情報ID
     * @param string displayName LINE表示名
     * @param string replyToken  リプライトークン
     * 
     * @return ReplyMessageResponse
     */
    private function replyFollow($replyToken, $lineId, $displayName)
    {
        try
        {
            // リプレイメッセージのフォーマットを取得
            $replyFollowMessage = config('line.reply_follow_message');
            // サービス提供者設定ページのURLを取得
            $settingServiceProviderUrl = config('line.setting_service_provider_url');

            // テキストメッセージを生成
            $textMessage = sprintf($replyFollowMessage, $displayName, $settingServiceProviderUrl);

            // リプライメッセージ送信
            $response = $this->replyTextMessage($replyToken, $textMessage, $lineId);

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