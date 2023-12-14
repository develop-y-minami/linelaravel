<?php

namespace App\Traits\Relations;

use App\Models\LineUserCorporate;

/**
 * HasOne Relation
 * 
 */
trait HasOneLineUserCorporate
{
    /**
     * LINEユーザー企業情報を取得
     * 
     * @return LineUserCorporate LINEユーザー企業情報
     */
    public function lineUserCorporate()
    {
        return $this->hasOne(LineUserCorporate::class)->withDefault(function($model) {
            $model->id = 0;
            $model->line_user_id = 0;
            $model->department_name = null;
            $model->department_name_kana = null;
            $model->manager = null;
            $model->url = null;
        });
    }
}