<?php

namespace App\Traits\Relations;

use App\Models\UserAccountType;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToUserAccountType
{
    /**
     * 担当者アカウント種別情報を取得
     * 
     * @return UserAccountType 担当者アカウント種別情報
     */
    public function userAccountType()
    {
        return $this->belongsTo(UserAccountType::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
        });
    }
}