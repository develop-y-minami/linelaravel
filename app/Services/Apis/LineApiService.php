<?php

namespace App\Services\Apis;

use App\Repositorys\LineMessageImageRepositoryInterface;
use App\Repositorys\LineNoticeRepositoryInterface;
use App\Repositorys\LineOfUserNoticeSettingRepositoryInterface;
use App\Repositorys\LineRepositoryInterface;
use App\Repositorys\LineTalkHistoryRepositoryInterface;
use App\Jsons\LineApis\Line;
use App\Jsons\LineApis\LineAccountStatus;
use App\Jsons\LineApis\LineAccountType;
use App\Jsons\LineApis\LineNotice;
use App\Jsons\LineApis\LineNoticeType;
use App\Jsons\LineApis\LineTalk;
use App\Jsons\LineApis\LineTalkContentImages;
use App\Jsons\LineApis\LineTalkContentImage;
use App\Jsons\LineApis\LineTalkContentText;
use App\Jsons\LineApis\LineTalkHistory;
use App\Jsons\LineApis\LineUser;
use App\Jsons\LineApis\ServiceProvider;
use App\Jsons\LineApis\User;
use Carbon\Carbon;

/**
 * LineApiService
 * 
 */
class LineApiService extends LineMessagingApiService implements LineApiServiceInterface
{
    /**
     * LineMessageImageRepositoryInterface
     * 
     */
    private $lineMessageImageRepository;
    /**
     * LineNoticeRepositoryInterface
     * 
     */
    private $lineNoticeRepository;
    /**
     * LineOfUserNoticeSettingRepositoryInterface
     * 
     */
    private $lineOfUserNoticeSettingRepository;
    /**
     * LineRepositoryInterface
     * 
     */
    private $lineRepository;

    /**
     * __construct
     * 
     * @param LineMessageImageRepositoryInterface        lineMessageImageRepository
     * @param LineNoticeRepositoryInterface              lineNoticeRepository
     * @param LineOfUserNoticeSettingRepositoryInterface lineOfUserNoticeSettingRepository
     * @param LineRepositoryInterface                    lineRepository
     * @param LineTalkHistoryRepositoryInterface         lineTalkHistoryRepository
     */
    public function __construct(
        LineMessageImageRepositoryInterface $lineMessageImageRepository,
        LineNoticeRepositoryInterface $lineNoticeRepository,
        LineOfUserNoticeSettingRepositoryInterface $lineOfUserNoticeSettingRepository,
        LineRepositoryInterface $lineRepository,
        LineTalkHistoryRepositoryInterface $lineTalkHistoryRepository
    )
    {
        $this->lineMessageImageRepository = $lineMessageImageRepository;
        $this->lineNoticeRepository = $lineNoticeRepository;
        $this->lineOfUserNoticeSettingRepository = $lineOfUserNoticeSettingRepository;
        $this->lineRepository = $lineRepository;
        $this->lineTalkHistoryRepository = $lineTalkHistoryRepository;
    }

    /**
     * LINE情報を取得
     * 
     * @param int id ID
     * @return Line LINE情報
     */
    public function getLine($id)
    {
        return $this->getLineJsonObject($data);
    }

    /**
     * LINE情報を返却
     * 
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    serviceProviderId   サービス提供者ID
     * @param int    userId              担当者ID
     * @return array LINE情報
     */
    public function getLines(
        $lineAccountTypeId = null,
        $lineAccountStatusId = null,
        $displayName = null,
        $serviceProviderId = null,
        $userId = null
    )
    {
        // 返却データ
        $result = array();

        // LINE情報を取得
        $datas = $this->lineRepository->findByconditions($lineAccountTypeId, $lineAccountStatusId, $displayName, $serviceProviderId, $userId);
        foreach ($datas as $data)
        {
            // 配列に追加
            $result[] = $this->getLineJsonObject($data);
        }

        return $result;
    }

    /**
     * LINE通知情報を返却
     * 
     * @param string noticeDate        通知日
     * @param int    lineNoticeTypeId  LINE通知種別
     * @param string displayName       LINE 表示名
     * @param int    serviceProviderId サービス提供者ID
     * @param int    userId            担当者ID
     * @return array LINE通知情報
     */
    public function getNotices(
        $noticeDate = null,
        $lineNoticeTypeId = null,
        $displayName = null,
        $serviceProviderId = null,
        $userId = null
    )
    {
        // 返却データ
        $result = array();

        // LINE通知情報を取得
        $datas = $this->lineNoticeRepository->findByconditions($noticeDate, $lineNoticeTypeId, $displayName, $serviceProviderId, $userId);
        foreach ($datas as $data)
        {
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider($data->line->serviceProvider->id, $data->line->serviceProvider->name);
            // ユーザー情報を設定
            $user = new User($data->line->user->id, $data->line->user->name);
            // LINEアカウント状態を設定
            $lineAccountStatus = new LineAccountStatus($data->line->lineAccountStatus->id, $data->line->lineAccountStatus->name);
            // LINEアカウント種別を設定
            $lineAccountType = new LineAccountType($data->line->lineAccountType->id, $data->line->lineAccountType->name);
            // LINE情報を設定
            $line = new Line($data->line->id, $data->line->display_name, $data->line->picture_url, $lineAccountStatus, $lineAccountType, $serviceProvider, $user);
            // LINE通知種別を設定
            $lineNoticeType = new LineNoticeType($data->lineNoticeType->id, $data->lineNoticeType->display_name);
            // LINE通知情報を設定
            $lineNotice = new LineNotice($data->id, $data->notice_date_time, $data->content, $lineNoticeType, $line);

            // 配列に追加
            $result[] = $lineNotice;
        }

        return $result;
    }

    /**
     * サービス提供者情報を更新
     * 
     * @param array ids               LINE情報ID
     * @param int   serviceProviderId サービス提供者ID
     * @return array LINE情報
     */
    public function updatesServiceProvider($ids, $serviceProviderId)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // 返却データ
            $result = array();

            $serviceProviderSettingDate;
            if ($serviceProviderId == null) {
                $serviceProviderSettingDate = null;
            } else {
                // 現在日付を設定
                $serviceProviderSettingDate = Carbon::today()->__toString();
            }

            // サービス提供者情報を更新
            $this->lineRepository->updatesServiceProvider($ids, $serviceProviderId, $serviceProviderSettingDate);

            // LINE情報を取得
            $datas = $this->lineRepository->findByIds($ids);
            foreach ($datas as $data)
            {
                // 配列に追加
                $result[] = $this->getLineJsonObject($data);
            }

            // コミット
            \DB::commit();

            return $result;
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * LINE情報JSONオブジェクトを返却
     * 
     * @param Line data LINE情報
     * @return Line JSONオブジェクト
     */
    private function getLineJsonObject($data)
    {
        // LINEユーザー情報を設定
        $lineUser = new LineUser($data->lineUser->id, $data->lineUser->account_id);
        // サービス提供者情報を設定
        $serviceProvider = new ServiceProvider($data->serviceProvider->id, $data->serviceProvider->name);
        // ユーザー情報を設定
        $user = new User($data->user->id, $data->user->name);
        // LINEアカウント状態を設定
        $lineAccountStatus = new LineAccountStatus($data->lineAccountStatus->id, $data->lineAccountStatus->name);
        // LINEアカウント種別を設定
        $lineAccountType = new LineAccountType($data->lineAccountType->id, $data->lineAccountType->name);
        // LINE情報を設定
        $line = new Line(
            $data->id,
            $data->display_name,
            $data->picture_url,
            $lineAccountStatus,
            $lineAccountType,
            $lineUser,
            $serviceProvider,
            $user
        );

        return $line;
    }

    /**
     * LINE担当者情報を設定
     * 
     * @param int   id                LINE情報ID
     * @param bool  noticeSetting     LINE通知設定
     * @param array lineNoticeSttings LINE通知種別設定
     * @param int   userId            担当者ID
     */
    public function userSetting($id, $noticeSetting, $lineNoticeSttings, $userId)
    {
        // LINE情報を取得
        $line = $this->lineRepository->findById($id);

        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // LINE情報を更新
            if ($line->user_id != $userId || $line->line_of_user_notice != $noticeSetting)
            {
                $line->user_id = $userId;
                $line->line_of_user_notice = $noticeSetting;
                $this->lineRepository->save($line);
            }

            // LINE担当者通知設定情報を削除
            $this->lineOfUserNoticeSettingRepository->deleteByLineId($id);

            if ($noticeSetting == true)
            {
                // LINE担当者通知設定情報を作成
                $this->lineOfUserNoticeSettingRepository->inserts($id, $lineNoticeSttings);
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
     * LINEトーク履歴を取得
     * 
     * @param int id                  LINE情報ID
     * @param int lineTalkHistoryTerm LINEトーク履歴表示期間
     * @return array LINEトーク履歴
     */
    public function talkHistorys($id, $lineTalkHistoryTerm)
    {
        // 返却データ
        $result = array();

        $dateTimeFrom = null;
        $dateTimeTo = null;
        switch ($lineTalkHistoryTerm)
        {
            case \LineTalkHistoryTerm::DAY['value']:
                // LINEトーク履歴表示期間：１日
                $dateTimeFrom = Carbon::today()->__toString();
                $dateTimeTo = Carbon::today()->endOfDay()->__toString();
                break;
            case \LineTalkHistoryTerm::WEEK['value']:
                // LINEトーク履歴表示期間：１週間
                $dateTimeFrom = Carbon::today()->subWeek(1)->__toString();
                $dateTimeTo = Carbon::today()->endOfDay()->__toString();
                break;
            case \LineTalkHistoryTerm::MONTH['value']:
                // LINEトーク履歴表示期間：１ヵ月
                $dateTimeFrom = Carbon::today()->subMonth(1)->__toString();
                $dateTimeTo = Carbon::today()->endOfDay()->__toString();
                break;
        }

        // トーク日を保持する変数
        $saveTalkDate = '';

        // トーク内容を保持する変数
        $saveLineTalks = [];

        // LINEメッセージ画像情報のimage_set_idを保持
        $existsImageSetIds = [];

        // カウンター
        $count = 0;

        // LINEトーク履歴情報を取得
        $datas = $this->lineTalkHistoryRepository->findByconditions($id, $dateTimeFrom, $dateTimeTo);
        foreach ($datas as $data)
        {
            // 日時を取得
            $dateTime = new Carbon($data->date_time);

            // トーク日を取得
            $talkDate = $dateTime->toDateString();
            if ($count == 0)
            {
                // 初回実行時のみ保持
                $saveTalkDate = $talkDate;
            }

            // トークコンテンツを設定
            $lineTalkContent = null;
            if ($data->from_to == 'to')
            {
                // 受信内容
                switch ($data->type_id)
                {
                    case \LineNoticeType::MESSAGE:
                        // メッセージの形式を取得
                        $messageType = $data->lineMessage->line_message_type_id;
                        switch ($messageType)
                        {
                            case \LineMessageType::TEXT :
                                // テキスト形式
                                $lineTalkContent = new LineTalkContentText($messageType, $data->lineMessage->lineMessageText->text);
                                break;
                            case \LineMessageType::IMAGE :
                                // 画像形式
                                $lineTalkContentImages = array();

                                // image_set_idを保持
                                $imageSetId = $data->lineMessage->lineMessageImage->image_set_id;

                                if ($imageSetId == null)
                                {
                                    // LINEメッセージ画像情報を設定
                                    $lineTalkContentImage = new LineTalkContentImage($data->lineMessage->lineMessageImage->file_path);
                                    $lineTalkContentImages[] = $lineTalkContentImage;
                                }
                                else
                                {
                                    // 画像同時送信の場合
                                    if (in_array($imageSetId, $existsImageSetIds))
                                    {
                                        // 既に処理済みの画像の為、スキップ
                                        continue 3;
                                    }
                                    else
                                    {
                                        // image_set_idを配列に追加
                                        $existsImageSetIds[] = $imageSetId;

                                        // 同一image_set_idのデータを取得
                                        $lineMessageImages = $this->lineMessageImageRepository->findByImageSetId($imageSetId);
                                        foreach ($lineMessageImages as $lineMessageImage)
                                        {
                                            $lineTalkContentImage = new LineTalkContentImage($lineMessageImage->file_path);
                                            $lineTalkContentImages[] = $lineTalkContentImage;
                                        }
                                    }
                                }

                                $lineTalkContent = new LineTalkContentImages($messageType, $lineTalkContentImages);
                                break;
                        }
                        break;
                }
            }
            else if ($data->from_to == 'from')
            {
                // 送信内容
                switch ($data->type_id)
                {
                    case \LineSendMessageType::TEXT:
                        $lineTalkContent = new LineTalkContentText(1, $data->lineSendMessage->lineSendMessageText->text);
                        break;
                }
            }

            // LINEトーク内容を設定
            $lineTalk = new LineTalk(
                $data->from_to,
                $dateTime->toTimeString(),
                $data->sender,
                $data->type_id,
                $data->type_name,
                $lineTalkContent
            );

            // トーク日が切り替わった場合に処理を実行
            if ($saveTalkDate != $talkDate)
            {
                // LINEトーク履歴を生成
                $lineTalkHistory = new LineTalkHistory($saveTalkDate, $saveLineTalks);

                // 日付毎にトーク履歴を保持
                $result[] = $lineTalkHistory;

                // 変数を更新
                $saveTalkDate = $talkDate;
                $saveLineTalks = [];
            }

            // 配列にデータを保持
            $saveLineTalks[] = $lineTalk;

            // カウントアップ
            $count++;
        }

        // 残りのトーク履歴を処理
        if (count($saveLineTalks) > 0)
        {
            // LINEトーク履歴を生成
            $result[] = new LineTalkHistory($saveTalkDate, $saveLineTalks);
        }

        return $result;
    }
}