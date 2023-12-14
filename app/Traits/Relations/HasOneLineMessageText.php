<?php

namespace App\Traits\Relations;

use App\Models\LineMessageText;

/**
 * HasOne Relation
 * 
 */
trait HasOneLineMessageText
{
    /**
     * LINEメッセージテキスト情報を取得
     * 
     * @return LineMessageText LINEメッセージテキスト情報
     */
    public function lineMessageText()
    {
        return $this->hasOne(LineMessageText::class)->withDefault(function($model) {
            $model->id = 0;
            $model->line_message_id = 0;
            $model->text = null;
        });
    }
}