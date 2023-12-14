<?php

namespace App\Traits\Relations;

use App\Models\LineUserIndividual;

/**
 * HasOne Relation
 * 
 */
trait HasOneLineUserIndividual
{
    /**
     * LINEユーザー個人情報を取得
     * 
     * @return LineUserIndividual LINEユーザー個人情報
     */
    public function lineUserIndividual()
    {
        return $this->hasOne(LineUserIndividual::class)->withDefault(function($model) {
            $model->id = 0;
            $model->line_user_id = 0;
            $model->gender_id = 0;
            $model->birth_date = null;
        });
    }
}