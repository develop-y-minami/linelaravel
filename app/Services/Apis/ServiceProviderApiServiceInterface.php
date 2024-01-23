<?php

namespace App\Services\Apis;

/**
 * ServiceProviderApiServiceInterface
 * 
 */
interface ServiceProviderApiServiceInterface
{
    /**
     * サービス提供者情報を取得
     * 
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @return array サービス提供者情報
     */
    public function getServiceProviders(
        $providerId = null,
        $name = null,
        $useStartDateTime = null,
        $useEndDateTime = null,
        $useStop = null
    );

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
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @return ServiceProvider サービス提供者情報
     */
    public function register($providerId, $name, $useStartDateTime, $useEndDateTime);

    /**
     * サービス提供者情報を更新
     * 
     * @param int    id               サービス提供者情報ID
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @return ServiceProvider サービス提供者情報
     */
    public function update($id, $providerId, $name, $useStartDateTime, $useEndDateTime, $useStop);

    /**
     * サービス提供者情報を削除
     * 
     * @param int id サービス提供者情報ID
     * @return int 削除件数
     */
    public function destroy($id);
}