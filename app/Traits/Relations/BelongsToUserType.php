<?php

namespace App\Traits\Relations;

use App\Models\UserType;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToUserType
{
    /**
     * 担当者種別情報を取得
     * 
     * @return UserType 担当者種別情報
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
        });
    }
}