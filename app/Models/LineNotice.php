<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineNotice
 * 
 */
class LineNotice extends Model
{
    use HasFactory;
    use \App\Traits\Relations\BelongsToLine;
    use \App\Traits\Relations\BelongsToLineMessage;
    use \App\Traits\Relations\BelongsToLineNoticeType;

    /**
     * 登録/更新を許可するカラム
     *
     */
    protected $fillable = [
        'notice_date_time',
        'line_notice_type_id',
        'line_id',
        'content',
        'line_message_id',
    ];
}
