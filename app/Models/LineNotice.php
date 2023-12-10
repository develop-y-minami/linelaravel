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
    use \App\Traits\Relations\BelongsToLineNoticeType;
}
