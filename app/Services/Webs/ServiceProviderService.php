<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Repositorys\ServiceProviderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * ServiceProviderService
 * 
 */
class ServiceProviderService implements ServiceProviderServiceInterface
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
     * @param int id サービス提供者ID
     * @return ServiceProvider サービス提供者情報
     */
    public function getServiceProvider($id)
    {
        return $this->serviceProviderRepository->findById($id);
    }

    /**
     * サービス提供者セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        // 返却データ
        $result = array();

        // サービス提供者情報を取得し設定
        if (\AppFacade::loginUserIsServiceProvider())
        {
            // ログイン中のサービス提供者情報を取得し設定
            $data = $this->serviceProviderRepository->findById(Auth::user()->service_provider_id);
            $result[] = new SelectItem($data->id, $data->name);
        }
        else
        {
            // 運用者の場合は全サービス提供者を取得
            $datas = $this->serviceProviderRepository->getAll();
            foreach ($datas as $data)
            {
                $result[] = new SelectItem($data->id, $data->name);
            }
        }

        return $result;
    }
}