<?php

namespace App\Traits\Relations;

use App\Models\Prefecture;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToPrefecture
{
    /**
     * 都道府県を取得
     * 
     * @return Prefecture 都道府県
     */
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
        });
    }
}