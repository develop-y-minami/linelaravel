<?php

namespace App\Traits\Relations;

use App\Models\LineSendMessage;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToLineSendMessage
{
    /**
     * LINE送信メッセージ情報を取得
     * 
     * @return LineSendMessage LINE送信メッセージ情報
     */
    public function lineSendMessage()
    {
        return $this->belongsTo(LineSendMessage::class)->withDefault(function($model) {
            $model->id = 0;
            $model->send_date_time = 0;
            $model->line_send_message_origin_id = 0;
            $model->line_send_message_type_id = 0;
            $model->line_id = 0;
            $model->user_id = 0;
        });
    }
}