<?php

namespace App\Traits\Relations;

use App\Models\Line;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToLine
{
    /**
     * LINE情報を取得
     * 
     * @return Line LINE情報
     */
    public function line()
    {
        return $this->belongsTo(Line::class)->withDefault(function($model) {
            $model->id = 0;
            $model->account_id = null;
            $model->display_name = null;
            $model->picture_url = null;
            $model->user_id = null;
            $model->line_account_type_id = 0;
        });
    }
}