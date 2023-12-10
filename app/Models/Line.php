<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Line
 * 
 */
class Line extends Model
{
    use HasFactory;
    use \App\Traits\Relations\BelongsToLineAccountType;
    use \App\Traits\Relations\BelongsToUser;
}
