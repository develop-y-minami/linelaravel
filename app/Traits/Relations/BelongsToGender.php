<?php

namespace App\Traits\Relations;

use App\Models\Gender;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToGender
{
    /**
     * 性別を取得
     * 
     * @return Gender 性別
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
        });
    }
}