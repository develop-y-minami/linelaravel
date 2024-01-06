<?php

namespace App\Repositorys;

/**
 * ServiceProviderRepositoryInterface
 * 
 */
interface ServiceProviderRepositoryInterface
{
    /**
     * サービス提供者情報を取得
     * 
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @return Collection サービス提供者情報
     */
    public function findByconditions(
        $providerId = null,
        $name = null,
        $useStartDateTime = null,
        $useEndDateTime = null,
        $useStop = null
    );

    /**
     * サービス提供者情報を登録
     * 
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @return ServiceProvider サービス提供者情報
     */
    public function register($providerId, $name, $useStartDateTime, $useEndDateTime, $useStop = false);

    /**
     * サービス提供者情報を削除
     * 
     * @param int id サービス提供者情報ID
     * @return int 削除件数
     */
    public function destroy($id);
}