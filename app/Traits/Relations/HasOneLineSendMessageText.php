<?php

namespace App\Traits\Relations;

use App\Models\LineSendMessageText;

/**
 * HasOne Relation
 * 
 */
trait HasOneLineSendMessageText
{
    /**
     * LINE送信メッセージテキスト情報を取得
     * 
     * @return LineSendMessageText LINE送信メッセージテキスト情報
     */
    public function lineSendMessageText()
    {
        return $this->hasOne(LineSendMessageText::class)->withDefault(function($model) {
            $model->id = 0;
            $model->line_send_message_id = 0;
            $model->text = null;
        });
    }
}