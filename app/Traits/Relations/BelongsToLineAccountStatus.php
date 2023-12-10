<?php

namespace App\Traits\Relations;

use App\Models\LineAccountStatus;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToLineAccountStatus
{
    /**
     * LINEアカウント種別を取得
     * 
     * @return LineAccountStatus LINEアカウント状態
     */
    public function lineAccountStatus()
    {
        return $this->belongsTo(LineAccountStatus::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
        });
    }
}