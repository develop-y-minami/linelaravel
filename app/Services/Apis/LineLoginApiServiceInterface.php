<?php

namespace App\Services\Apis;

/**
 * LineLoginApiServiceInterface
 * 
 */
interface LineLoginApiServiceInterface
{
    /**
     * アクセストークンを検証
     * 
     * @param string accessToken アクセストークン
     * @return bool 検証結果
     */
    public function verify($accessToken);
}