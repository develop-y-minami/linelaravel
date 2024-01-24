<?php

namespace App\Traits\Relations;

use App\Models\ServiceProvider;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToServiceProvider
{
    /**
     * サービス提供者情報を取得
     * 
     * @return ServiceProvider サービス提供者情報
     */
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class)->withDefault(function($model) {
            $model->id = 0;
            $model->provider_id = null;
            $model->name = null;
            $model->use_start_date = null;
            $model->use_end_date = null;
            $model->use_stop_flg = false;
        });
    }
}