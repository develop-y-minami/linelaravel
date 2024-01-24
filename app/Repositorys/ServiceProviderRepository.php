<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\ServiceProvider;

/**
 * ServiceProviderRepository
 * 
 * サービス提供者情報
 * 
 */
class ServiceProviderRepository implements ServiceProviderRepositoryInterface
{
    /**
     * 全データ取得
     * 
     * @return Collection サービス提供者情報
     */
    public function getAll()
    {
        return ServiceProvider::get();
    }

    /**
     * ID検索
     * 
     * @param int id ID
     * @return ServiceProvider サービス提供者情報
     */
    public function findById($id)
    {
        return ServiceProvider::find($id);
    }

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
    public function findByconditions($providerId = null, $name = null, $useStartDate = null, $useEndDate = null, $useStopFlg = null)
    {
        $query = ServiceProvider::query();

        // 提供者ID
        if ($providerId !== null) $query->whereProviderId($providerId);

        // 提供者名
        if ($name != null) $query->where('name', 'LIKE', "$name%");

        // 利用開始日
        if ($useStartDate != null) $query->where('use_start_date', '>=', $useStartDate);

        // 利用終了日
        if ($useEndDate != null) $query->where('use_end_date', '<=', $useEndDate);

        // 利用停止フラグ
        if ($useStopFlg !== null) $query->whereUseStopFlg($useStopFlg);

        $query->orderBy('provider_id');

        return $query->get();
    }

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
    public function register($providerId, $name, $useStartDate, $useEndDate, $useStopFlg = false)
    {
        return ServiceProvider::create([
            'provider_id' => $providerId,
            'name' => $name,
            'use_start_date' => $useStartDate,
            'use_end_date' => $useEndDate,
            'use_stop_flg' => $useStopFlg
        ]);
    }

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
    public function update($id, $providerId, $name, $useStartDate, $useEndDate, $useStopFlg)
    {
        return ServiceProvider::where('id', $id)->update([
            'provider_id' => $providerId,
            'name' => $name,
            'use_start_date' => $useStartDate,
            'use_end_date' => $useEndDate,
            'use_stop_flg' => $useStopFlg
        ]);
    }

    /**
     * 削除
     * 
     * @param int id ID
     * @return int 削除件数
     */
    public function destroy($id)
    {
        return ServiceProvider::destroy($id);
    }
}