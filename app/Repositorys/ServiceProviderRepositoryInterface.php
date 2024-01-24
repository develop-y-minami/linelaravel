<?php

namespace App\Repositorys;

/**
 * ServiceProviderRepositoryInterface
 * 
 * サービス提供者情報
 * 
 */
interface ServiceProviderRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection サービス提供者情報
     */
    public function getAll();

    /**
     * ID検索
     * 
     * @param int id ID
     * @return ServiceProvider サービス提供者情報
     */
    public function findById($id);

    /**
     * 条件指定検索
     * 
     * @param string providerId   提供者ID
     * @param string name         提供者名
     * @param string useStartDate 利用開始日
     * @param string useEndDate   利用終了日
     * @param bool   useStopFlg   利用停止フラグ
     * @return Collection サービス提供者情報
     */
    public function findByconditions($providerId = null, $name = null, $useStartDate = null, $useEndDate = null, $useStopFlg = null);

    /**
     * 登録
     * 
     * @param string providerId   提供者ID
     * @param string name         提供者名
     * @param string useStartDate 利用開始日
     * @param string useEndDate   利用終了日
     * @param bool   useStopFlg   利用停止フラグ
     * @return ServiceProvider サービス提供者情報
     */
    public function register($providerId, $name, $useStartDate, $useEndDate, $useStopFlg = false);

    /**
     * 更新
     * 
     * @param int    id           ID
     * @param string providerId   提供者ID
     * @param string name         提供者名
     * @param string useStartDate 利用開始日
     * @param string useEndDate   利用終了日
     * @param bool   useStopFlg   利用停止フラグ
     * @return int 更新数
     */
    public function update($id, $providerId, $name, $useStartDate, $useEndDate, $useStopFlg);

    /**
     * 削除
     * 
     * @param int id ID
     * @return int 削除件数
     */
    public function destroy($id);
}