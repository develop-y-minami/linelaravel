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
            $model->line_channel_user_id = null;
            $model->line_channel_group_id = null;
            $model->line_channel_display_name = null;
            $model->line_channel_picture_url = null;
            $model->line_account_type_id = 0;
            $model->line_account_status_id = 0;
            $model->service_provider_id = null;
            $model->service_provider_setting_date = null;
            $model->user_id = null;
            $model->user_setting_date = null;
            $model->line_of_user_notice = false;
            $model->line_id = null;
        });
    }
}