<?php

namespace App\Services\Liffs;

use App\Repositorys\ServiceProviderRepositoryInterface;

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
}