<?php

namespace App\Traits\Relations;

use App\Models\LineUser;

/**
 * HasOne Relation
 * 
 */
trait HasOneLineUser
{
    /**
     * LINEユーザー情報を取得
     * 
     * @return LineUser LINEユーザー情報
     */
    public function lineUser()
    {
        return $this->hasOne(LineUser::class)->withDefault(function($model) {
            $model->id = 0;
            $model->line_id = 0;
            $model->account_id = null;
            $model->personality_id = null;
            $model->name = null;
            $model->name_kana = null;
            $model->mail = null;
            $model->tel_number = null;
            $model->fax_number = null;
            $model->post = null;
            $model->prefecture_id = 0;
            $model->municipalitie = null;
            $model->house_number = null;
            $model->building = null;
        });
    }
}