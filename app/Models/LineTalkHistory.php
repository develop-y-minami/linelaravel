<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineTalkHistory
 * 
 * LINEトーク履歴情報
 * 
 */
class LineTalkHistory extends Model
{
    use HasFactory;
    use \App\Traits\Relations\BelongsToLineMessage;
    use \App\Traits\Relations\BelongsToLineSendMessage;
}
