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
use App\Repositorys\LineSendMessageFlexRepositoryInterface;
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
     * LineSendMessageFlexRepositoryInterface
     * 
     */
    private $lineSendMessageFlexRepository;
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
     * @param LineSendMessageFlexRepositoryInterface lineSendMessageFlexRepository
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
        LineSendMessageFlexRepositoryInterface $lineSendMessageFlexRepository,
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
        $this->lineSendMessageFlexRepository = $lineSendMessageFlexRepository;
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

            // LINE情報を保持
            $line;

            if ($sourceType == 'user')
            {
                // ユーザーIDを設定
                $userId = \ArrayFacade::getArrayValue($source, 'userId');
                // LINE情報を取得
                $line = $this->lineRepository->findByLineChannelUserIdAndLineAccountTypeId($userId, \LineAccountType::ONE_TO_ONE);
                if ($line == null)
                {
                    // LINE情報に登録
                    $line = $this->registerLineOneToOne($userId, \LineAccountStatus::FOLLOW);
                }
            }
            else
            {
                // グループIDを設定
                $groupId = \ArrayFacade::getArrayValue($source, 'groupId');
                $userId = \ArrayFacade::getArrayValue($source, 'userId');

                // グループトークのLINE情報を取得
                $lineGroup = $this->lineRepository->findByLineChannelGroupIdAndLineAccountTypeId($groupId, \LineAccountType::GROUP);
                if ($lineGroup == null)
                {
                    // LINE情報に登録
                    $lineGroup = $this->registerLineGroup($groupId, \LineAccountStatus::JOIN);
                }

                // グループメンバーのLINE情報を取得
                $line = $this->lineRepository->findByLineChannelGroupIdAndUserIdAndLineAccountTypeId($groupId, $userId, \LineAccountStatus::JOIN);
                if ($line == null)
                {
                    // LINE情報に登録
                    $line = $this->registerLineGroupMember($groupId, $userId, \LineAccountStatus::JOIN, $lineGroup->id);
                }
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
            $line = $this->lineRepository->findByLineChannelUserIdAndLineAccountTypeId($userId, \LineAccountType::ONE_TO_ONE);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->registerLineOneToOne($userId, \LineAccountStatus::FOLLOW);
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
                $this->replyFollow($replyToken, $line->id, $line->line_channel_display_name);
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
            $line = $this->lineRepository->findByLineChannelUserIdAndLineAccountTypeId($userId, \LineAccountType::ONE_TO_ONE);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->registerLineOneToOne($userId, \LineAccountStatus::UNFOLLOW);
            }
            else
            {
                // LINE情報が既に登録済み時の処理を実行
                if ($line->line_account_status_id == \LineAccountStatus::FOLLOW)
                {
                    // 友達の場合はブロックに状態を変更
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
     * グループ参加イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string groupId   グループID
     * @param int    timestamp タイムスタンプ
     */
    public function join($type, $groupId, $timestamp)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // LINE情報を取得
            $line = $this->lineRepository->findByLineChannelGroupIdAndLineAccountTypeId($groupId, \LineAccountType::GROUP);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->registerLineGroup($groupId, \LineAccountStatus::JOIN);
            }
            else
            {
                // LINE情報が既に登録済み時の処理を実行
                if ($line->line_account_status_id == \LineAccountStatus::LEAVE)
                {
                    // 退出中の場合は参加中に状態を変更
                    $line = $this->lineRepository->saveLineAccountStatus($line, \LineAccountStatus::JOIN);
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
     * グループ退出イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string groupId   グループID
     * @param int    timestamp タイムスタンプ
     */
    public function leave($type, $groupId, $timestamp)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // LINE情報を取得
            $line = $this->lineRepository->findByLineChannelGroupIdAndLineAccountTypeId($groupId, \LineAccountType::GROUP);
            if ($line == null)
            {
                // LINE情報に登録
                $line = $this->registerLineGroup($groupId, \LineAccountStatus::LEAVE);
            }
            else
            {
                // LINE情報が既に登録済み時の処理を実行
                if ($line->line_account_status_id == \LineAccountStatus::JOIN)
                {
                    // 参加中の場合は退出中に状態を変更
                    $line = $this->lineRepository->saveLineAccountStatus($line, \LineAccountStatus::LEAVE);
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
     * グループメンバー退出イベント時の処理を実行
     * 
     * @param string type      タイプ
     * @param string groupId   グループID
     * @param array  members   退出メンバー情報
     * @param int    timestamp タイムスタンプ
     */
    public function memberLeft($type, $groupId, $members, $timestamp)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // グループトークのLINE情報を取得
            $lineGroup = $this->lineRepository->findByLineChannelGroupIdAndLineAccountTypeId($groupId, \LineAccountType::GROUP);
            if ($lineGroup == null)
            {
                // LINE情報に登録
                $lineGroup = $this->registerLineGroup($groupId, \LineAccountStatus::LEAVE);
            }

            // 退出メンバーの件数分処理
            foreach ($members as $member) {
                // ユーザーIDを取得
                $userId = $member['userId'];

                // グループメンバーのLINE情報を取得
                $line = $this->lineRepository->findByLineChannelGroupIdAndUserIdAndLineAccountTypeId($groupId, $userId, \LineAccountStatus::JOIN);
                if ($line == null)
                {
                    // 退出済みのLINEプロフィール情報は取得できないため登録処理は実行しない
                }
                else
                {
                    // LINE情報が既に登録済み時の処理を実行
                    if ($line->line_account_status_id == \LineAccountStatus::JOIN)
                    {
                        // 参加中の場合は退出中に状態を変更
                        $line = $this->lineRepository->saveLineAccountStatus($line, \LineAccountStatus::LEAVE);
                    }
                }

                // LINE通知情報を作成
                $lineNotice = $this->registerLineNotice($type, $line->id, $timestamp);
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
     * １対１トークのLINE情報を登録
     * 
     * @param string            userId              ユーザーID
     * @param LineAccountStatus lineAccountStatusId LINEアカウント状態情報ID
     * @return Line LINE情報
     */
    private function registerLineOneToOne($userId, $lineAccountStatusId)
    {
        try
        {
            // LINEプロフィール情報を取得
            $response = $this->messagingApi->getProfile($userId);
            $displayName = $response->getDisplayName();
            $pictureUrl = $response->getPictureUrl();

            // LINE情報に登録
            return $this->lineRepository->register(
                null,
                $userId,
                $displayName,
                $pictureUrl,
                $lineAccountStatusId,
                \LineAccountType::ONE_TO_ONE
            );
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * グループトークのLINE情報を登録
     * 
     * @param string            groupId             グループID
     * @param LineAccountStatus lineAccountStatusId LINEアカウント状態
     * @return Line LINE情報
     */
    private function registerLineGroup($groupId, $lineAccountStatusId)
    {
        try
        {
            // LINEグループ情報を取得
            $response = $this->messagingApi->getGroupSummary($groupId);
            $groupName = $response->getGroupName();
            $pictureUrl = $response->getPictureUrl();

            // LINE情報に登録
            return $this->lineRepository->register(
                $groupId,
                null,
                $groupName,
                $pictureUrl,
                $lineAccountStatusId,
                \LineAccountType::GROUP
            );
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * グループメンバーのLINE情報を登録
     * 
     * @param string            groupId             グループID
     * @param string            userId              ユーザーID
     * @param LineAccountStatus lineAccountStatusId LINEアカウント状態情報ID
     * @param int               lineId              親LINE情報ID
     * @return Line LINE情報
     */
    private function registerLineGroupMember($groupId, $userId, $lineAccountStatusId, $lineId)
    {
        try
        {
            // LINEプロフィール情報を取得
            $response = $this->messagingApi->getGroupMemberProfile($groupId, $userId);
            $displayName = $response->getDisplayName();
            $pictureUrl = $response->getPictureUrl();

            // LINE情報に登録
            return $this->lineRepository->register(
                $groupId,
                $userId,
                $displayName,
                $pictureUrl,
                $lineAccountStatusId,
                \LineAccountType::GROUP_MEMBER,
                $lineId
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
     * リプライメッセージ（テキスト形式）を送信
     * 
     * @param string replyToken リプライトークン
     * @param string text       メッセージ
     * @param int    lineId     LINE情報ID
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
            $lineSendMessage = $this->lineSendMessageRepository->register(
                $sendDateTime,
                \LineSendMessageOrigin::REPLY,
                \LineSendMessageType::TEXT,
                $lineId,
                0
            );

            // LINE送信メッセージテキスト情報を登録
            $lineSendMessageText = $this->lineSendMessageTextRepository->register($lineSendMessage->id, $text);

            // テキストメッセージを生成
            $message = new TextMessage(['type' => 'text','text' => $text]);

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
     * リプライメッセージ（Flex形式）を送信
     * 
     * @param string replyToken リプライトークン
     * @param string altText    通知テキスト
     * @param string contents   Flexコンテンツ
     * @param int    lineId     LINE情報ID
     * @param int    liffPageId LIFFページ種別情報ID
     * 
     * @return ReplyMessageResponse
     */
    private function replyFlexMessage($replyToken, $altText, $contents ,$lineId ,$liffPageId)
    {
        try
        {
            // 送信日時を取得
            $sendDateTime = Carbon::now()->format('Y-m-d H:i:s.v');

            // LINE送信メッセージ情報を登録
            $lineSendMessage = $this->lineSendMessageRepository->register(
                $sendDateTime,
                \LineSendMessageOrigin::REPLY,
                \LineSendMessageType::FLEX,
                $lineId,
                0
            );

            // Flexコンテンツをjson文字列に変換
            $contentJsonString = json_encode($contents);

            // LINE送信メッセージFlex情報を登録
            $lineSendMessageFlex = $this->lineSendMessageFlexRepository->register($lineSendMessage->id, $liffPageId, $altText, $contentJsonString);

            // Flexメッセージを生成
            $message = new FlexMessage(['type' => 'flex','altText' => $altText, 'contents' => $contents]);

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

            // LINE情報IDをクエリパラメータに設定
            $settingServiceProviderUrl = $settingServiceProviderUrl.'/?liffPageId='.\LiffPage::SETTING_SERVICE_PROVIDER.'&lineId='.$lineId;

            // テキストメッセージを生成
            $textMessage = sprintf($replyFollowMessage, $displayName);

            // 通知テキストを設定
            $altText = '友達追加ありがとうございます';

            // Flexコンテンツを生成
            $contents = array (
                'type' => 'bubble',
                'body' => array (
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => array (
                        0 => array (
                            'type' => 'box',
                            'layout' => 'vertical',
                            'contents' => array (
                                0 => array (
                                    'type' => 'text',
                                    'text' => $textMessage,
                                    'wrap' => true,
                                ),
                            ),
                        ),
                    ),
                ),
                'footer' => array (
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => array (
                        0 => array (
                            'type' => 'separator',
                            'color' => '#849ebf',
                        ),
                        1 => array (
                            'type' => 'button',
                            'action' => array (
                                'type' => 'uri',
                                'label' => 'サービス提供者設定',
                                'uri' => $settingServiceProviderUrl,
                            ),
                        ),
                    ),
                    'paddingAll' => 'none',
                ),
            );

            // リプライメッセージ送信
            $response = $this->replyFlexMessage($replyToken, $altText, $contents, $lineId, \LiffPage::SETTING_SERVICE_PROVIDER);

            return $response;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}