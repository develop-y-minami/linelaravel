<?php

namespace App\Services\Apis;

/**
 * ServiceProviderApiServiceInterface
 * 
 * サービス提供者情報
 * 
 */
interface ServiceProviderApiServiceInterface
{
    /**
     * サービス提供者情報を取得
     * 
     * @param string providerId   提供者ID
     * @param string name         提供者名
     * @param string useStartDate 利用開始日
     * @param string useEndDate   利用終了日
     * @param bool   useStopFlg   利用停止フラグ
     * @return array サービス提供者情報
     */
    public function getServiceProviders($providerId = null, $name = null, $useStartDate = null, $useEndDate = null, $useStopFlg = null);

    /**
     * LINE数推移情報を取得
     * 
     * @param int    id                 サービス提供者情報ID
     * @param string transitionDateFrom 日付：FROM
     * @param string transitionDateTo   日付：TO
     * @return array LINE数推移情報
     */
    public function getLineTransitions($id, $transitionDateFrom = null, $transitionDateTo  = null);

    /**
     * サービス提供者情報を登録
     * 
     * @param string providerId   提供者ID
     * @param string name         提供者名
     * @param string useStartDate 利用開始日
     * @param string useEndDate   利用終了日
     * @return ServiceProvider サービス提供者情報
     */
    public function register($providerId, $name, $useStartDate, $useEndDate);

    /**
     * サービス提供者情報を更新
     * 
     * @param int    id           ID
     * @param string providerId   提供者ID
     * @param string name         提供者名
     * @param string useStartDate 利用開始日
     * @param string useEndDate   利用終了日
     * @param bool   useStopFlg   利用停止フラグ
     * @return ServiceProvider サービス提供者情報
     */
    public function update($id, $providerId, $name, $useStartDate, $useEndDate, $useStopFlg);

    /**
     * サービス提供者情報を削除
     * 
     * @param int id ID
     * @return int 削除件数
     */
    public function destroy($id);
}