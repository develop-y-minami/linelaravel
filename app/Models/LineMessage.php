<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineMessage
 * 
 * LINEメッセージ情報
 * 
 */
class LineMessage extends Model
{
    use HasFactory;
    use \App\Traits\Relations\HasOneLineMessageText;
    use \App\Traits\Relations\HasOneLineMessageImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'line_message_type_id',
        'line_channel_message_id',
        'line_channel_quote_token',
        'line_notice_id',
    ];
}
