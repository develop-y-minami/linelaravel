<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineMessage
 * 
 */
class LineMessage extends Model
{
    use HasFactory;

    /**
     * 登録/更新を許可するカラム
     *
     */
    protected $fillable = [
        'type',
        'message_id',
        'quote_token',
    ];
}
