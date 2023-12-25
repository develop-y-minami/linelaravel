<?php

namespace App\Services\Apis;

use App\Repositorys\LineNoticeSettingRepositoryInterface;
use App\Repositorys\LineRepositoryInterface;
use App\Repositorys\LineTalkHistoryRepositoryInterface;
use App\Jsons\LineApis\Line;
use App\Jsons\LineApis\LineAccountStatus;
use App\Jsons\LineApis\LineAccountType;
use App\Jsons\LineApis\LineTalk;
use App\Jsons\LineApis\LineTalkContentMessage;
use App\Jsons\LineApis\LineTalkHistory;
use App\Jsons\LineApis\User;
use Carbon\Carbon;

/**
 * LineApiService
 * 
 */
class LineApiService implements LineApiServiceInterface
{
    /**
     * LineNoticeSettingRepositoryInterface
     * 
     */
    private $lineNoticeSettingRepository;
    /**
     * LineRepositoryInterface
     * 
     */
    private $lineRepository;

    /**
     * __construct
     * 
     * @param LineNoticeSettingRepositoryInterface lineNoticeSettingRepository
     * @param LineRepositoryInterface              lineRepository
     * @param LineTalkHistoryRepositoryInterface   lineTalkHistoryRepository
     */
    public function __construct(
        LineNoticeSettingRepositoryInterface $lineNoticeSettingRepository,
        LineRepositoryInterface $lineRepository,
        LineTalkHistoryRepositoryInterface $lineTalkHistoryRepository
    )
    {
        $this->lineNoticeSettingRepository = $lineNoticeSettingRepository;
        $this->lineRepository = $lineRepository;
        $this->lineTalkHistoryRepository = $lineTalkHistoryRepository;
    }

    /**
     * LINE情報を返却
     * 
     * @param int    lineAccountTypeId   LINEアカウント種別
     * @param int    lineAccountStatusId LINEアカウント状態
     * @param string displayName         LINE 表示名
     * @param int    userId              担当者ID
     * @return array LINE情報
     */
    public function getLines(
        $lineAccountTypeId = null,
        $lineAccountStatusId = null,
        $displayName = null,
        $userId = null
    )
    {
        // 返却データ
        $result = array();

        // LINE情報を取得
        $datas = $this->lineRepository->findByconditions($lineAccountTypeId, $lineAccountStatusId, $displayName, $userId);
        foreach ($datas as $data)
        {
            // ユーザー情報を設定
            $user = new User($data->user->id, $data->user->name);
            // LINEアカウント状態を設定
            $lineAccountStatus = new LineAccountStatus($data->lineAccountStatus->id, $data->lineAccountStatus->name);
            // LINEアカウント種別を設定
            $lineAccountType = new LineAccountType($data->lineAccountType->id, $data->lineAccountType->name);
            // LINE情報を設定
            $line = new Line($data->id, $data->display_name, $data->picture_url, $lineAccountStatus, $lineAccountType, $user);

            // 配列に追加
            $result[] = $line;
        }

        return $result;
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

            // LINE通知設定情報を削除
            $this->lineNoticeSettingRepository->deleteByLineId($id);

            if ($noticeSetting == true)
            {
                // LINE通知設定情報を作成
                $this->lineNoticeSettingRepository->inserts($id, $lineNoticeSttings);
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

        // トーク日を保持する変数
        $saveTalkDate = '';

        // トーク内容を保持する変数
        $saveLineTalks = [];

        // カウンター
        $count = 0;

        // LINEトーク履歴情報を取得
        $datas = $this->lineTalkHistoryRepository->findByconditions($id, $lineTalkHistoryTerm);
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
                        $lineTalkContent = new LineTalkContentMessage($data->lineMessage->lineMessageText->text);
                        break;
                }
            }
            else if ($data->from_to == 'from')
            {
                // 送信内容
                switch ($data->type_id)
                {
                    case \LineSendMessageType::TEXT:
                        $lineTalkContent = new LineTalkContentMessage($data->lineSendMessage->lineSendMessageText->text);
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