<?php

namespace App\Traits\Relations;

use App\Models\User;

/**
 * BelongsTo Relation
 * 
 */
trait BelongsToUser
{
    /**
     * 担当者情報を取得
     * 
     * @return User 担当者情報
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(function($model) {
            $model->id = 0;
            $model->name = null;
            $model->email = null;
            $model->email_verified_at = null;
            $model->password = null;
            $model->remember_token = null;
        });
    }
}