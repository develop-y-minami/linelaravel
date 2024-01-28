<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineSendMessageFlex
 * 
 * LINE送信メッセージFlex情報
 * 
 */
class LineSendMessageFlex extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'line_send_message_id',
        'liff_page_type_id',
        'alt_text',
        'content',
    ];
}
