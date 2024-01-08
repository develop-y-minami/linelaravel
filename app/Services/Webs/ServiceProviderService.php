<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Repositorys\ServiceProviderRepositoryInterface;

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
     * サービス提供者セレクトボックスに設定するデータを返却
     * 
     * @return array 選択項目
     */
    public function getSelectItems()
    {
        // 返却データ
        $result = array();

        // 担当者情報を取得し設定
        $datas = $this->serviceProviderRepository->getAll();
        foreach ($datas as $data)
        {
            $result[] = new SelectItem($data->id, $data->name);
        }

        return $result;
    }
}