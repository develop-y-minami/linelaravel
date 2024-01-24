<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineSendMessageText
 * 
 * LINE送信メッセージテキスト情報
 * 
 */
class LineSendMessageText extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'line_send_message_id',
        'text'
    ];
}
