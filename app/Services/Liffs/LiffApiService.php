<?php

namespace App\Services\Liffs;

use App\Repositorys\ServiceProviderRepositoryInterface;
use App\Jsons\LiffApis\ServiceProvider;

/**
 * LiffApiService
 * 
 * LIFF Api
 * 
 */
class LiffApiService implements LiffApiServiceInterface
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
    public function __construct(
        ServiceProviderRepositoryInterface $serviceProviderRepository
    )
    {
        $this->serviceProviderRepository = $serviceProviderRepository;
    }

    /**
     * サービス提供者情報を取得
     * 提供者ID検索
     * 
     * @param string providerId 提供者ID
     * @return ServiceProvider サービス提供者情報
     */
    public function getServiceProviderFindByProviderId($providerId)
    {
        // サービス提供者情報を取得
        $data = $this->serviceProviderRepository->findByProviderId($providerId);

        // 返却データを設定
        $serviceProvider = $this->getServiceProviderJsonObject($data);

        return $serviceProvider;
    }

    /**
     * サービス提供者情報JSONオブジェクトを取得
     * 
     * @param ServiceProvider data サービス提供者情報
     * @return ServiceProvider サービス提供者情報JSONオブジェクト
     */
    private function getServiceProviderJsonObject($data)
    {
        return new ServiceProvider($data->id, $data->provider_id, $data->name);
    }
}