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
    use \App\Traits\Relations\HasOneLineMessageText;
    use \App\Traits\Relations\HasOneLineMessageImage;

    /**
     * 登録/更新を許可するカラム
     *
     */
    protected $fillable = [
        'line_message_type_id',
        'message_id',
        'quote_token',
    ];
}
