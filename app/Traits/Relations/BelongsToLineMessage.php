<?php

namespace App\Traits\Relations;

use App\Models\LineMessage;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToLineMessage
{
    /**
     * LINEメッセージ情報を取得
     * 
     * @return LineMessage LINEメッセージ情報
     */
    public function lineMessage()
    {
        return $this->belongsTo(LineMessage::class)->withDefault(function($model) {
            $model->id = 0;
            $model->type = null;
            $model->message_id = null;
            $model->quote_token = null;
        });
    }
}