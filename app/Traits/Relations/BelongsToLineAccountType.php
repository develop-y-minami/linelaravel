<?php

namespace App\Traits\Relations;

use App\Models\LineAccountType;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToLineAccountType
{
    /**
     * LINEアカウント種別を取得
     * 
     * @return LineAccountType LINEアカウント種別
     */
    public function lineAccountType()
    {
        return $this->belongsTo(LineAccountType::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
        });
    }
}