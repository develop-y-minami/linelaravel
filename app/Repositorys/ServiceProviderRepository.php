<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\ServiceProvider;

/**
 * ServiceProviderRepository
 * 
 */
class ServiceProviderRepository implements ServiceProviderRepositoryInterface
{
    /**
     * 全サービス提供者情報を取得
     * 
     * @return Collection サービス提供者情報
     */
    public function getAll()
    {
        return ServiceProvider::get();
    }

    /**
     * サービス提供者情報を取得
     * 
     * @param int id サービス提供者情報ID
     * @return ServiceProvider サービス提供者情報
     */
    public function findById($id)
    {
        return ServiceProvider::find($id);
    }

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
    )
    {
        $query = ServiceProvider::query();

        // サービス提供者ID
        if ($providerId !== null) $query->whereProviderId($providerId);

        // サービス提供者名
        if ($name != null) $query->where('name', 'LIKE', "$name%");

        // サービス利用開始日
        if ($useStartDateTime != null) $query->where('use_start_date_time', '>=', $useStartDateTime);

        // サービス利用終了日
        if ($useEndDateTime != null) $query->where('use_end_date_time', '<=', $useEndDateTime);

        // サービス利用状態
        if ($useStop !== null) $query->whereUseStop($useStop);

        $query->orderBy('provider_id');

        return $query->get();
    }

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
    public function register($providerId, $name, $useStartDateTime, $useEndDateTime, $useStop = false)
    {
        return ServiceProvider::create([
            'provider_id' => $providerId,
            'name' => $name,
            'use_start_date_time' => $useStartDateTime,
            'use_end_date_time' => $useEndDateTime,
            'use_stop' => $useStop
        ]);
    }

    /**
     * サービス提供者情報を更新
     * 
     * @param int    id               サービス提供者情報ID
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @return int 更新数
     */
    public function update($id, $providerId, $name, $useStartDateTime, $useEndDateTime, $useStop)
    {
        return ServiceProvider::where('id', $id)->update([
            'provider_id' => $providerId,
            'name' => $name,
            'use_start_date_time' => $useStartDateTime,
            'use_end_date_time' => $useEndDateTime,
            'use_stop' => $useStop
        ]);
    }

    /**
     * サービス提供者情報を削除
     * 
     * @param int id サービス提供者情報ID
     * @return int 削除件数
     */
    public function destroy($id)
    {
        return ServiceProvider::destroy($id);
    }
}