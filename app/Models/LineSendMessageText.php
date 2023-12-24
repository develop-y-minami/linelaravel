<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineSendMessageText
 * 
 */
class LineSendMessageText extends Model
{
    use HasFactory;

    /**
     * 登録/更新を許可するカラム
     *
     */
    protected $fillable = [
        'line_send_message_id',
        'text'
    ];
}
