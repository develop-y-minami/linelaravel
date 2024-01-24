<?php

namespace App\Traits\Relations;

use App\Models\LineMessageImage;

/**
 * HasOne Relation
 * 
 */
trait HasOneLineMessageImage
{
    /**
     * LINEメッセージ画像情報を取得
     * 
     * @return LineMessageImage LINEメッセージ画像情報
     */
    public function lineMessageImage()
    {
        return $this->hasOne(LineMessageImage::class)->withDefault(function($model) {
            $model->id = 0;
            $model->line_message_id = 0;
            $model->line_channel_content_provider_type = null;
            $model->line_channel_content_provider_original_content_url = null;
            $model->line_channel_content_provider_preview_image_url = null;
            $model->line_channel_image_set_id = null;
            $model->line_channel_image_set_index = 0;
            $model->line_channel_image_set_total = 0;
            $model->file_path = null;
        });
    }
}