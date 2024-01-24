<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineSendMessage
 * 
 * LINE送信メッセージ情報
 * 
 */
class LineSendMessage extends Model
{
    use HasFactory;
    use \App\Traits\Relations\HasOneLineSendMessageText;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'send_date_time',
        'line_send_message_origin_id',
        'line_send_message_type_id',
        'line_id',
        'user_id',
    ];
}
