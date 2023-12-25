<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineSendMessage
 * 
 */
class LineSendMessage extends Model
{
    use HasFactory;
    use \App\Traits\Relations\HasOneLineSendMessageText;

    /**
     * 登録/更新を許可するカラム
     *
     */
    protected $fillable = [
        'send_date_time',
        'line_send_message_origin_id',
        'line_send_message_type_id',
        'line_id',
        'user_id',
    ];
}
