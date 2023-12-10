<?php

namespace App\Traits\Relations;

use App\Models\LineNoticeType;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToLineNoticeType
{
    /**
     * 通知種別を取得
     * 
     * @return LineNoticeType 通知種別
     */
    public function lineNoticeType()
    {
        return $this->belongsTo(LineNoticeType::class)->withDefault(function($model) {
            $model->id = 0;
            $model->type = null;
            $model->origin = null;
            $model->display_name = null;
            $model->content = null;
        });
    }
}