<?php

namespace App\Traits\Relations;

use App\Models\LineMessage;

/**
 * HasOne Relation
 * 
 */
trait HasOneLineMessage
{
    /**
     * LINEメッセージ情報を取得
     * 
     * @return LineMessage LINEメッセージ情報
     */
    public function lineMessage()
    {
        return $this->hasOne(LineMessage::class)->withDefault(function($model) {
            $model->id = 0;
            $model->line_message_type_id = 0;
            $model->line_channel_message_id = null;
            $model->line_channel_quote_token = null;
            $model->line_notice_id = null;
        });
    }
}