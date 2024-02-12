<?php

namespace App\Services\Liffs;

use App\Services\Apis\LineLoginApiService;
use App\Repositorys\LineRepositoryInterface;
use App\Repositorys\ServiceProviderRepositoryInterface;
use App\Jsons\LiffApis\ServiceProvider;
use Carbon\Carbon;

/**
 * LiffApiService
 * 
 * LIFF Api
 * 
 */
class LiffApiService extends LineLoginApiService implements LiffApiServiceInterface
{
    /**
     * LineRepositoryInterface
     * 
     */
    private $lineRepository;
    /**
     * ServiceProviderRepositoryInterface
     * 
     */
    private $serviceProviderRepository;

    /**
     * __construct
     * 
     * @param LineRepositoryInterface            lineRepository
     * @param ServiceProviderRepositoryInterface serviceProviderRepository
     */
    public function __construct(
        LineRepositoryInterface $lineRepository,
        ServiceProviderRepositoryInterface $serviceProviderRepository
    )
    {
        parent::__construct();
        $this->lineRepository = $lineRepository;
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
     * サービス提供者情報を更新
     * 
     * @param int id LINE情報ID
     * @param int serviceProviderId サービス提供者情報ID
     * @return ServiceProvider サービス提供者情報
     */
    public function updateServiceProvider($id, $serviceProviderId)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // LINE情報を取得
            $line = $this->lineRepository->findById($id);

            // サービス提供者設定日を設定
            $serviceProviderSettingDate = Carbon::today()->__toString();

            if ($line->line_account_type_id == \LineAccountType::ONE_TO_ONE)
            {
                // 更新するLINE情報をロック

                // １対１の場合はLINE情報のサービス提供者情報を更新
                $this->lineRepository->updateServiceProvider($id, $serviceProviderId, $serviceProviderSettingDate);
            }
            elseif ($line->line_account_type_id == \LineAccountType::GROUP)
            {
                // LINEグループIDでLINE情報を取得
                $lines = $this->lineRepository->findByLineChannelGroupId($line->line_channel_group_id);
                
            }

            // サービス提供者情報を取得
            $serviceProvider = $this->serviceProviderRepository->findById($serviceProviderId);

            // サービス提供者情報を設定
            $result = $this->getServiceProviderJsonObject($serviceProvider);

            // コミット
            //\DB::commit();

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