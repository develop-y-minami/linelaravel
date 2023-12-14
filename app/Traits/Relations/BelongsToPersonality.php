<?php

namespace App\Traits\Relations;

use App\Models\Personality;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToPersonality
{
    /**
     * 人格を取得
     * 
     * @return Personality 人格
     */
    public function personality()
    {
        return $this->belongsTo(Personality::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
        });
    }
}