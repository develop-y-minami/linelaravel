<?php

namespace App\Services\Apis;

use App\Repositorys\ServiceProviderRepositoryInterface;
use App\Jsons\ServiceProviderApis\ServiceProvider;

/**
 * ServiceProviderApiService
 * 
 */
class ServiceProviderApiService implements ServiceProviderApiServiceInterface
{
    /**
     * ServiceProviderRepositoryInterface
     * 
     */
    private $serviceProviderRepository;

    /**
     * __construct
     * 
     * @param ServiceProviderRepositoryInterface serviceProviderRepository
     */
    public function __construct(ServiceProviderRepositoryInterface $serviceProviderRepository)
    {
        $this->serviceProviderRepository = $serviceProviderRepository;
    }

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
    )
    {
        // 返却データ
        $result = array();

        // サービス提供者情報を取得
        $datas = $this->serviceProviderRepository->findByconditions($providerId, $name, $useStartDateTime, $useEndDateTime, $useStop);
        foreach ($datas as $data)
        {
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider(
                $data->id,
                $data->provider_id,
                $data->name,
                $data->use_start_date_time,
                $data->use_end_date_time,
                $data->use_stop,
                \ServiceProviderUseStop::getName($data->use_stop)
            );

            // 配列に追加
            $result[] = $serviceProvider;
        }

        return $result;
    }

    /**
     * サービス提供者情報を登録
     * 
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @return ServiceProvider サービス提供者情報
     */
    public function register($providerId, $name, $useStartDateTime, $useEndDateTime)
    {
        // サービス提供者情報を登録
        $data = $this->serviceProviderRepository->register($providerId, $name, $useStartDateTime, $useEndDateTime);
        // サービス提供者情報を設定
        $serviceProvider = new ServiceProvider(
            $data->id,
            $data->provider_id,
            $data->name,
            $data->use_start_date_time,
            $data->use_end_date_time,
            $data->use_stop,
            \ServiceProviderUseStop::getName($data->use_stop)
        );

        return $serviceProvider;
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
     * @return ServiceProvider サービス提供者情報
     */
    public function update($id, $providerId, $name, $useStartDateTime, $useEndDateTime, $useStop)
    {
        // サービス提供者情報を更新
        $this->serviceProviderRepository->update($id, $providerId, $name, $useStartDateTime, $useEndDateTime, $useStop);

        // サービス提供者情報を設定
        $serviceProvider = new ServiceProvider(
            $id,
            $providerId,
            $name,
            $useStartDateTime,
            $useEndDateTime,
            $useStop,
            \ServiceProviderUseStop::getName($useStop)
        );
        
        return $serviceProvider;
    }

    /**
     * サービス提供者情報を削除
     * 
     * @param int id サービス提供者情報ID
     * @return int 削除件数
     */
    public function destroy($id)
    {
        // サービス提供者情報を削除
        return $this->serviceProviderRepository->destroy($id);
    }
}